<?php

namespace Wavvve\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Wavvve\Events\UserRegistered' => [
            'Wavvve\Listeners\SendActivationEmail',
        ],
        'Wavvve\Events\UserRequestedActivationEmail' => [
            'Wavvve\Listeners\SendActivationEmail',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
