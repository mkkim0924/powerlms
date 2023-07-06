<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistrationEvent implements ShouldQueue
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
