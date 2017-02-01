<?php

namespace Wavvve\Jobs\Passes;

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
        // $ctx = stream_context_create();
        // stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/forge/wavvve.io/pushcert.pem');
        // stream_context_set_option($ctx, 'ssl', 'passphrase', '1234');
        // // stream_context_set_option($ctx, 'ssl', 'cafile', '/home/forge/wavvve.io/wwdr.pem');
        // $fp = stream_socket_client(
        //     'ssl://gateway.push.apple.com:2195', $err,
        //     $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        // $body['aps'] = array();
        // // Encode the payload as JSON
        // $payload = json_encode($body);
        // $msg = chr(0) . pack("n",32) . pack('H*', $this->testPT) . pack("n",strlen($payload)) . $payload;
        // fwrite($fp, $msg);
        // fclose($fp);

        $passphrase = '1234';
        $deviceToken = '6429f7bade9ad66f2026e8ec6fed6a77c6d018475f1dbcc1728349565c7270bb';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'pushcert.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
          'ssl://gateway.push.apple.com:2195', $err,
          $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (! $fp) {
            exit("Failed to connect: $err $errstr".PHP_EOL);
        }

        echo 'Connected to APNS'.PHP_EOL;

        // Create the payload body
        $body['aps'] = [];

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0).pack('n', 32).pack('H*', $deviceToken).pack('n', strlen($payload)).$payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        if (! $result) {
            echo 'Message not delivered'.PHP_EOL;
        } else {
            echo 'Message successfully delivered'.PHP_EOL;
        }

        // Close the connection to the server
        fclose($fp);
    }
}
