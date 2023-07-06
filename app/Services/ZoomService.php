<?php

namespace App\Services;

use MacsiDigital\Zoom\Facades\Zoom;

class ZoomService
{
    public function meetingCreateOrUpdate($data, $meeting_id = null, $updateMeeting = false): array
    {
        try{
            $user = Zoom::user()->get()->first();
            $meetingData = [
                'topic' => $data['title'],
                'type' => 2,
                'agenda' => $data['description'],
                'duration' => $data['duration'],
                'password' => $data['password'],
                'start_time' => $data['start_at'],
                'timezone' => config('zoom.timezone'),
            ];
            if ($updateMeeting){
                $meeting = Zoom::meeting()->find($meeting_id);
                $meeting->update($meetingData);
            }else{
                $meeting = Zoom::meeting()->make($meetingData);
            }
            $meeting->settings()->make([
                'join_before_host' => config('zoom.join_before_host') ? true : false,
                'host_video' => config('zoom.host_video') ? true : false,
                'participant_video' => config('zoom.participant_video') ? true : false,
                'mute_upon_entry' => config('zoom.mute_upon_entry') ? true : false,
                'waiting_room' => config('zoom.waiting_room') ? true : false,
                'approval_type' => config('zoom.approval_type'),
                'audio' => config('zoom.audio'),
                'auto_recording' => config('zoom.auto_recording'),
            ]);
            return ['status' => true, 'data' => $user->meetings()->save($meeting)];
        }catch (\Exception $e){
            return ['status' => false, 'message' => __('backend.zoom.flash_message.please_enter_a_valid')];
        }
    }

    public function meetingDelete($meetingId): bool
    {
        $meeting = Zoom::meeting()->find($meetingId);
        $meeting->delete();
        return true;
    }
}
