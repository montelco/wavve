<?php

namespace Wavvve\Providers;

use Mail;
use Wavvve\User;
use Psr\Log\LoggerInterface;
use Wavvve\Events\UserRegistered;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::created(function ($user) {
            $token = $user->activationToken()->create([
                'token' => str_random(127),
            ]);

            $samplePass = $user->passes()->create([
                'title' => 'Test Pass (Delete Me)',
                'template_number' => '1',
                'primary_field' => 'Delete me after your first login.',
                'secondary_field' => 'This is just a demo pass.',
                'cashier_helper' => 'This is cashier helper text so they know what to do with this pass.',
                'one_time_redemption' => true,
                'uuid' => str_random(7),
            ]);

            event(new UserRegistered($user));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('bugsnag.logger', Log::class);
        $this->app->alias('bugsnag.logger', LoggerInterface::class);
    }
}
