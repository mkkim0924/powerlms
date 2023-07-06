<?php

namespace App\Observers;

use App\Events\LiveLessonSlotDetailsMailEvent;
use App\Models\LiveLessonSlot;
use App\Models\LiveLessonSlotUser;

class LiveLessonSlotUserObserver
{
    public function created(LiveLessonSlotUser $liveLessonSlotUser)
    {
        LiveLessonSlot::where('id', $liveLessonSlotUser->live_lesson_slot_id)->decrement('remaining_seats');
        $emailData = [
            'name' => $liveLessonSlotUser->userDetails->name,
            'email' => $liveLessonSlotUser->userDetails->email,
            'title' => $liveLessonSlotUser->slotDetails->title ?? "",
            'start_at' => formatDate($liveLessonSlotUser->slotDetails->start_at),
            'duration' => $liveLessonSlotUser->slotDetails->duration ?? "",
            'meeting_id' => $liveLessonSlotUser->slotDetails->meeting_id ?? "",
            'password' => $liveLessonSlotUser->slotDetails->password ?? 'No Password',
            'join_url' => $liveLessonSlotUser->slotDetails->join_url ?? '',
        ];
        event(new LiveLessonSlotDetailsMailEvent($emailData));
    }

    public function deleted(LiveLessonSlotUser $liveLessonSlotUser)
    {
        LiveLessonSlot::where('id', $liveLessonSlotUser->live_lesson_slot_id)->increment('remaining_seats');
    }
}
