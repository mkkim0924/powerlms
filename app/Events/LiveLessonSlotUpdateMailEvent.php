<?php

namespace App\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class LiveLessonSlotUpdateMailEvent implements ShouldQueue
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }
}
