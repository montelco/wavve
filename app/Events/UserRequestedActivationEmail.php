<?php

namespace Wavvve\Events;

use Wavvve\User;
use Illuminate\Queue\SerializesModels;

class UserRequestedActivationEmail
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
