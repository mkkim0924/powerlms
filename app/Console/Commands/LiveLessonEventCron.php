<?php

namespace App\Console\Commands;

use App\Events\LiveLessonSlotDeleteMailEvent;
use App\Events\LiveLessonSlotReminderMailEvent;
use App\Events\LiveLessonSlotUpdateMailEvent;
use App\Models\LiveLessonUserEventLog;
use Illuminate\Console\Command;

class LiveLessonEventCron extends Command
{
    protected $signature = 'run:live-lesson-cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send event wise mail to user for live lesson';

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
        $eventLogs = LiveLessonUserEventLog::wherehas('userDetails')->get();
        foreach ($eventLogs as $eventLog){
            $emailData = [
                'name' => $eventLog->userDetails->name ?? "",
                'email' => $eventLog->userDetails->email,
                'title' => $eventLog->slotDetails->title ?? "",
                'start_at' => formatDate($eventLog->slotDetails->start_at),
                'duration' => $eventLog->slotDetails->duration ?? "",
                'meeting_id' => $eventLog->slotDetails->meeting_id ?? "",
                'password' => $eventLog->slotDetails->password ?? 'No Password',
                'join_url' => $eventLog->slotDetails->join_url ?? '',
            ];
            if ($eventLog->event == 'update'){
                event(new LiveLessonSlotUpdateMailEvent($emailData));
            }elseif($eventLog->event == 'delete'){
                event(new LiveLessonSlotDeleteMailEvent($emailData));
            }elseif($eventLog->event == 'reminder'){
                event(new LiveLessonSlotReminderMailEvent($emailData));
            }
            $eventLog->delete();
        }
    }
}
