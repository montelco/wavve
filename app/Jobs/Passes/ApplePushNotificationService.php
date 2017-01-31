<?php

namespace Wavvve\Jobs\Passes;

use Wavvve\Pass;
use Carbon\Carbon;
use Wavvve\iOS_Pass;
use Wavvve\iOS_Device;
use Wavvve\iOS_Registration;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplePushNotificationService implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3; 
    public $timeout = 60;

    public $testUDID = 'fda31bdef14012a7634538ee9b15cc9b';
    public $testPT = '6429f7bade9ad66f2026e8ec6fed6a77c6d018475f1dbcc1728349565c7270bb';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
