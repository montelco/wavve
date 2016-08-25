<?php

namespace Wavvve\Http\Controllers;

use Wavvve\Pass;

class PublicAcessController extends Controller
{

    public function fetchBeaconPayload($user_id, $hardware_id, $lat, $lon)
    {
        return $user_id . " owns " . $hardware_id . " at location: " . $lat . ", " . $lon ;
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
