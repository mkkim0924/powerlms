<?php

namespace App\Events;

use App\Models\Admins;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminSetPasswordEvent implements ShouldQueue
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $admin;

    public function __construct(Admins $admin)
    {
        $this->admin = $admin;
    }
}
