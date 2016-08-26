<?php

namespace Wavvve\Http\Controllers;

use Wavvve\Pass;

class PublicAcessController extends Controller
{
    const WAVVVE_BASE_URL = '1f 02 01 06 03 03 aa fe 17 16 aa fe 10 00 03 77 61 76 76 76 65 2e 69 6f 2f ';

    public function fetchBeaconPayload($user_id, $hardware_id, $lat, $lon)
    {
        return response()->json(["payload" => self::WAVVVE_BASE_URL . rtrim(chunk_split(bin2hex(Pass::where('user_id', $user_id)->orderBy('created_at', 'desc')->first()['uuid']), 2, ' '), ' ')], 200);

    }

    public function pubAccess($uuid, Pass $pass)
    {
        $currentTime = date('Y-m-d H:i:s');
        $customerPass = Pass::where('uuid', $uuid)->first();
        if ($customerPass === null) {
            return abort('500');
        } else {
            if ($customerPass->published <= $currentTime) {
                switch ($customerPass->template_number) {
                    case 1:
                        return view('pub.pass_pub_template_one')->with('pass', $customerPass);
                        break;
                    case 2:
                        return view('pub.pass_pub_template_two')->with('pass', $customerPass);
                        break;
                    case 3:
                        return view('pub.pass_pub_template_three')->with('pass', $customerPass);
                        break;
                }
            } else {
                return abort('404');
            }
        }
    }

    public function setFlowCookie()
    {
    }

    public function caching()
    {
        //Caching JSON output to run for service workers.
    }
}
