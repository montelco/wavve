<?php

namespace Wavvve\Jobs\Passes;

use Wavvve\Pass;
use Wavvve\User;
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
        $this->testUDID = $testUDID;
        $this->testPT = $testPT;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = 'Welcome Nick Castellucci!';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/forge/wavvve.io/atmt.p12');
        stream_context_set_option($ctx, 'ssl', 'passphrase', '1234');
        stream_context_set_option($ctx, 'ssl', 'cafile', '/home/forge/wavvve.io/wwdr.pem');
        $fp = stream_socket_client(
            'ssl://gateway.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        $payload = json_encode(array("aps" => array("sound" => "default")));
        $msg = chr(0) . pack("n",32) . pack('H*', $testPT) . pack("n",strlen($payload)) . $payload;
        fwrite($fp, $msg);
        fclose($fp);
    }
}
