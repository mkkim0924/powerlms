<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminUserRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Country;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $adminUserRepository, $userRepository;

    public function __construct(AdminUserRepositoryInterface $adminUserRepository, UserRepositoryInterface $userRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
        $this->userRepository = $userRepository;

    }

    public function getProfile()
    {
        $admin = getCurrentAdmin();
        return view('admin.profile.index', compact('admin'));
    }

    public function getInstructorProfile()
    {
        $instructor = auth()->user();
        $countries = Country::get()->pluck('name', 'name')->toArray();
        $links = json_decode($instructor['social_links']);
        return view('admin.profile.instructor_index', compact('instructor', 'countries','links'));
    }

    public function updateProfile(Request $request)
    {
        $this->adminUserRepository->updateProfile($request);
        return redirect()->route('admin.profile')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function updateInstructorProfile(Request $request)
    {
        $this->userRepository->updateProfile($request);
        return redirect()->route('instructor.profile')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function getInstructorNotifications()
    {
        $instructor = getCurrentUser();
        $notifications = Notification::where('instructor_id', $instructor->id)->orderBy('id', 'DESC')->paginate(25);
        if ($instructor->unread_notifications_count > 0){
            Notification::where('instructor_id', $instructor->id)->update([
                'mark_as_read' => 1, 'read_at' => Carbon::now()
            ]);
            $instructor->update(['unread_notifications_count' => 0]);
        }
        return view('admin.user.instructor.notifications', compact('instructor', 'notifications'));
    }

    public function readInstructorNotification($id)
    {
        $notification = Notification::find($id);
        if ($notification->mark_as_read == 0){
            $notification->update(['mark_as_read' => 1, 'read_at' => Carbon::now()]);
        }
        $redirection_url = null;
        if (in_array($notification->identifier, ['student_purchase_course', 'student_purchase_bundle'])){
            $redirection_url = route('instructor.sales_report');
        }elseif (in_array($notification->identifier, ['admin_marks_course_as_pending', 'admin_marks_course_as_active'])){
            $redirection_url = route('instructor.courses');
        }elseif (in_array($notification->identifier, ['admin_course_review_submit'])){
            $redirection_url = route('instructor.courses.review', $notification->params['id']);
        }elseif (in_array($notification->identifier, ['payout_request_approve'])){
            $redirection_url = route('instructor.payout_report');
        }
        return response()->json(['redirect_url' => $redirection_url]);
    }
}
