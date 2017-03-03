<?php

namespace Wavvve\Jobs\Passes;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnpublishPass implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 3;
    public $timeout = 60;

    public $pass;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Pass::where('id', $this->id)->update(['published' => '0']);
    }
}
