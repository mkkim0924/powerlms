<?php

namespace App\Console\Commands;

use App\Events\LiveLessonSlotDeleteMailEvent;
use App\Events\LiveLessonSlotReminderMailEvent;
use App\Events\LiveLessonSlotUpdateMailEvent;
use App\Models\LiveLessonSlot;
use App\Models\LiveLessonUserEventLog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LiveLessonReminderCommand extends Command
{
    protected $signature = 'send:live-lesson-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will store slot wise reminder event.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reminderDateTime = Carbon::now()->addMinutes(30);
        $slots = LiveLessonSlot::whereHas('slotUsers')->where('start_at', '<=', $reminderDateTime)->where('reminder_sent', 0)->get();
        foreach ($slots as $slot){
            foreach ($slot->slotUsers as $slotUser){
                LiveLessonUserEventLog::firstOrCreate([
                    'user_id' => $slotUser->user_id,
                    'live_lesson_slot_id' => $slot->id,
                    'event' => 'reminder'
                ]);
            }
            $slot->update(['reminder_sent' => 1]);
        }
    }
}
