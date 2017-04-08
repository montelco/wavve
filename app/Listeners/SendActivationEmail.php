<?php

namespace Wavvve\Listeners;

use Mail;
use Wavvve\Mail\SendActivationToken;

class SendActivationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->user)->send(new SendActivationToken($event->user->activationToken));
    }
}
