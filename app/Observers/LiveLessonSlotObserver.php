<?php

namespace App\Observers;

use App\Models\LiveLessonSlot;
use App\Models\LiveLessonSlotUser;
use App\Models\LiveLessonUserEventLog;
use Carbon\Carbon;

class LiveLessonSlotObserver
{
    public function created(LiveLessonSlot $liveLessonSlot)
    {
        //Send Email
    }

    public function updated(LiveLessonSlot $liveLessonSlot)
    {
        //Send Email
        if ($liveLessonSlot->reminder_sent == 0){
            $slotAttendees = LiveLessonSlotUser::where('live_lesson_slot_id', $liveLessonSlot->id)->get();
            foreach ($slotAttendees as $attendee) {
                LiveLessonUserEventLog::firstOrCreate(['user_id' => $attendee->user_id, 'live_lesson_slot_id' => $liveLessonSlot->id, 'event' => 'updateTest']);
            }
        }
    }

    public function deleted(LiveLessonSlot $liveLessonSlot)
    {
        if ($liveLessonSlot->start_at >= Carbon::now()){
            $slotAttendees = LiveLessonSlotUser::where('live_lesson_slot_id', $liveLessonSlot->id)->get();
            foreach ($slotAttendees as $attendee) {
                LiveLessonUserEventLog::firstOrCreate(['user_id' => $attendee->user_id, 'live_lesson_slot_id' => $liveLessonSlot->id, 'event' => 'delete']);
            }
            LiveLessonSlotUser::where('live_lesson_slot_id', $liveLessonSlot->id)->delete();
        }
    }
}
