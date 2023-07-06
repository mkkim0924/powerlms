<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveLesson;
use App\Models\LiveLessonSlot;
use App\Models\LiveLessonSlotUser;
use App\Services\ZoomService;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;

class LiveLessonSlotController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function index(Request $request)
    {
        $liveLessonSlot = LiveLessonSlot::byInstructor()->get();
        return view('admin.live_lesson_slot.index', compact('liveLessonSlot'));
    }

    public function create()
    {
        $liveLesson = LiveLesson::byInstructor()->pluck('title', 'id')->toArray();
        return view('admin.live_lesson_slot.create', compact('liveLesson'));
    }

    public function edit($id)
    {
        $liveLessonSlot = LiveLessonSlot::byInstructor()->where('id', $id)->where('start_at', '>=', Carbon::now()->addDay())->first();
        if (empty($liveLessonSlot)) {
            return redirect()->back()->with('error', __('global.error.invalid_request'));
        }
        $liveLesson = LiveLesson::byInstructor()->pluck('title', 'id')->toArray();
        return view('admin.live_lesson_slot.edit', compact('liveLessonSlot', 'liveLesson'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'live_lesson_id' => "required",
            'title' => "required",
            'description' => "required",
            'start_at' => "required",
            'duration' => "required",
            'password' => "required",
        ]);
        $requestData = $request->all();
        $zoomResponse = $this->zoomService->meetingCreateOrUpdate($requestData);
        if ($zoomResponse['status']) {
            $liveLessonDetail = LiveLesson::find($requestData['live_lesson_id']);
            $requestData['course_id'] = $liveLessonDetail->course_id;
            $requestData['meeting_id'] = $zoomResponse['data']->id;
            $requestData['start_url'] = $zoomResponse['data']->start_url;
            $requestData['join_url'] = $zoomResponse['data']->join_url;
            $requestData['end_at'] = Carbon::parse($requestData['start_at'])->addMinutes($requestData['duration']);
            LiveLessonSlot::create($requestData);
            return redirect()->route(request()->user_type . '.liveLessonSlots')->with('success', __('global.flash_message.data_created_successfully'));
        } else {
            return redirect()->back()->with('error', $zoomResponse['message']);
        }
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'live_lesson_id' => "required",
            'title' => "required",
            'description' => "required",
            'start_at' => "required",
            'duration' => "required",
            'password' => "required",
        ]);
        $lessonSlot = LiveLessonSlot::find($id);
        $requestData = $request->all();
        $zoomResponse = $this->zoomService->meetingCreateOrUpdate($requestData, $lessonSlot->meeting_id, true);
        if ($zoomResponse['status']) {
            $requestData['course_id'] = $lessonSlot->liveLessonDetails->course_id;
            $requestData['meeting_id'] = $zoomResponse['data']->id;
            $requestData['start_url'] = $zoomResponse['data']->start_url;
            $requestData['join_url'] = $zoomResponse['data']->join_url;
            $requestData['end_at'] = Carbon::parse($requestData['start_at'])->addMinutes($requestData['duration']);
            $lessonSlot->update($requestData);
            return redirect()->route(request()->user_type . '.liveLessonSlots')->with('success', __('global.flash_message.data_updated_successfully'));
        } else {
            return redirect()->back()->with('error', $zoomResponse['message']);
        }
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $lessonSlot = LiveLessonSlot::byInstructor()->where('id', $id)->first();
        if (isset($lessonSlot)) {
            $this->zoomService->meetingDelete($lessonSlot->meeting_id);
            $lessonSlot->delete();
        }
        return redirect()->route(request()->user_type . '.liveLessonSlots')->with('success', __('global.flash_message.data_deleted_successfully'));
    }

    public function attendees($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $liveLessonSlot = LiveLessonSlot::byInstructor()->where('id', $id)->first();
        if (empty($liveLessonSlot)) {
            return redirect()->back()->with('error', __('global.error.invalid_request'));
        }
        return view('admin.live_lesson_slot.attendees', compact('liveLessonSlot'));
    }

    public function getZoomSettings(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $instructor = getCurrentUser();
        $select_configuration_values['approval_type'] = ['0' => 'Automatically', '1' => 'Manually', '2' => 'No Registration Required'];
        $select_configuration_values['audio'] = ['both' => 'Both', 'telephony' => 'Telephony', 'voip' => 'VoIP'];
        $select_configuration_values['auto_recording'] = ['none' => 'None', 'local' => 'Local', 'cloud' => 'Cloud'];
        $select_configuration_values['timezone'] = [];
        foreach (\DateTimeZone::listIdentifiers(DateTimeZone::ALL) as $timezone) {
            $select_configuration_values['timezone'][$timezone] = $timezone;
        }
        return view('admin.live_lesson_slot.zoom_settings', compact('instructor', 'select_configuration_values'));
    }

    public function updateZoomSettings(Request $request): \Illuminate\Http\RedirectResponse
    {
        $instructor = getCurrentUser();
        $updateData = $request->instructor_zoom_details;
        $switchInputs = ['join_before_host', 'host_video', 'participant_video', 'mute_upon_entry', 'waiting_room'];
        foreach ($switchInputs as $switchInput) {
            $updateData[$switchInput] = isset($updateData[$switchInput]) ? 1 : 0;
        }
        $instructor->update(['instructor_zoom_details' => $updateData]);
        return redirect()->route('instructor.zoomSettings')->with('success', __('global.flash_message.data_updated_successfully'));
    }
}
