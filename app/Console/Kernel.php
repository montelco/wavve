<?php

namespace Wavvve\Console;

use Carbon;
use Wavvve\Pass;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Pass::where('user_id', 1)->delete();
        })->everyFiveMinutes();

        //need a better way of doing this.

        // $schedule->call(function (Wavvve\User $account) {
        //     $testAccountID = $account->findOrFail(1);
        //     Pass::fill([
        //         'user_id' => $testAccountID->id,
        //         'title' => "Free WiFi",
        //         'template_number' => "1",
        //         'primary_field' => "Free WiFi for all of our customers. Just check your receipt for the daily password.",
        //         'secondary_field' => "Show this pass to the cashier for a special treat!",
        //         'barcode_value' => rand(100001,999999),
        //         'cashier_helper' => "Write down each use of this pass or enter reduction manually.",
        //         'coupon_full_background_image' => "https://ucarecdn.com/990cc694-5f95-402a-8ff1-03b7a5fd5b08/",
        //         'expiry' => Carbon\Carbon::now(),
        //         'uuid' => "RkW9oe6",
        //     ]);
        // })->everyFiveMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
