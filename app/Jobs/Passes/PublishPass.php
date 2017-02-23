<?php

namespace Wavvve\Jobs\Passes;

use Wavvve\User;
use Wavvve\Pass;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PublishPass implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 60;

    public $pass;
    public $user;
    public $time;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pass $pass, User $user, Carbon $time)
    {
        $this->pass = $pass;
        $this->user = $user;
        $this->time = $time;
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
