<?php

namespace Wavvve\Http\Controllers;

use Carbon;
use Wavvve\Pass;
use Wavvve\iOS_Pass;
use Wavvve\iOS_Device;
use Illuminate\Http\Request;
use Wavvve\iOS_Registration;
use Illuminate\Http\Response;

class PublicAcessController extends Controller
{
    const WAVVVE_BASE_URL = '1f 02 01 06 03 03 aa fe 17 16 aa fe 10 00 03 77 61 76 76 76 65 2e 69 6f 2f ';

    public function fetchBeaconPayload($user_id, $hardware_id, $lat, $lon)
    {
        return response()->json(['payload' => self::WAVVVE_BASE_URL.rtrim(chunk_split(bin2hex(Pass::where('user_id', $user_id)->orderBy('updated_at', 'desc')->firstOrFail()['uuid']), 2, ' '), ' ')], 200);
    }

    public function iBeaconUUID($user_id, $hardware_id, $lat, $lon)
    {
        return response()->json(['payload' => self::WAVVVE_BASE_URL.rtrim(chunk_split(bin2hex('2b 4f cf 51 4e aa 44 6d b2 4e 4d 1b 43 7f 38 40'), 2, ' '), ' ')], 200);
    }

    /**
     * This method handles interactions between the Wavvve production server and the Apple Push Noitification Service (APNs). It can register, delete, and notify subscribed users of updates to a Wallet pass's contents.
     * @param  string  $deviceID   The UUID generated by the Wallet application on an iOS Device.
     * @param  string  $passTypeID This is the Apple Developer issued pass type name (eg: "pass.com.atmt.example").
     * @param  string  $serial     This uniquely identifies the Wallet pass within the Wavvve platform and there is one per business username (eg: Churchill Coffee could have churchill-coffee as their unique serial).
     * @param  Request $request    This is the incoming request made by the APNs server and includes the Auth header field and the push token in the request body.
     * @return HTTP Response Code              This method returns the appropriate HTTP Response code given the logic and input.
     */
    public function postWallet($deviceID, $passTypeID, $serial, Request $request)
    {
        if ($request->isMethod('post')) {
            //Validates the incoming request by comparing the authorization_token as well as the pass serial (eg: churchill-coffee.pkpass) where the 'churchill-coffee' is the serial
            if (iOS_Pass::where('serial_no', $serial)->where('authentication_token', substr($request->header('authorization'), 10))->first()) {
                $uuid = $deviceID.'-'.$serial;
                if (iOS_Registration::where('uuid', $uuid)->count() < 1) {
                    //Device isn't registered, but it's addable
                    iOS_Device::create([
                        'device' => $deviceID,
                        'push_token' => $request->pushToken, ]);

                    iOS_Registration::create([
                        'uuid' => $uuid,
                        'pass_type_id' => $passTypeID,
                        'push_token' => $request->pushToken,
                        'ios_devices_id' => $deviceID,
                        'ios_passes_serial' => $serial, ]);

                    return response('Content created', 201);
                } else {
                    //Device is already registered. No further action is required.
                    return response('OK', 200);
                }
            } else {
                //This request cannot be determined to be authentic.
                return response('Unauthorized', 401);
            }
        } else {
            return response('Bad Request', 400);
        }
    }

    /**
     * This method deletes a devices registration entry from the database. Note that this removes the ios_registrations entry from the database, but not the ios_devices entry as a device can still remain registered to other passes.
     * @param  string  $deviceID   The UUID generated by the Wallet application on an iOS Device.
     * @param  string  $passTypeID This is the Apple Developer issued pass type name (eg: "pass.com.atmt.example").
     * @param  string  $serial     This uniquely identifies the Wallet pass within the Wavvve platform and there is one per business username (eg: Churchill Coffee could have churchill-coffee as their unique serial).
     * @param  Request $request    This is the incoming request made by the APNs server and includes the Auth header field and the push token in the request body.
     * @return HTTP Response Code              The respective code will be output to the iOS device.
     */
    public function deleteDevice($deviceID, $passTypeID, $serial, Request $request)
    {
        //Validates the incoming request by comparing the authorization_token as well as the pass serial (eg: churchill-coffee.pkpass) where the 'churchill-coffee' is the serial
            if (iOS_Pass::where('serial_no', $serial)->where('authentication_token', substr($request->header('authorization'), 10))->first()) {
                $uuid = $deviceID.'-'.$serial;
                if (iOS_Registration::where('uuid', $uuid)->count() > 0) {
                    $unRegisterDevice = iOS_Registration::where('ios_devices_id', $deviceID)->where('ios_passes_serial', $serial)->first();
                    $unRegisterDevice->delete();

                    //The deletion was successful. Return HTTP OK
                    return response('OK', 200);
                } else {
                    //Device isn't registered to the pass. This is an error, as a bad request has occurred.
                    return response('Bad Request', 400);
                }
            } else {
                //This request was incorrectly formed either in serial number or in the authorization token.
                return response('Unauthorized', 401);
            }
    }

    /**
     * This method handles update notifications on behalf of APNs Server for a given device.
     * @param  string  $deviceID   The UUID generated by the Wallet application on an iOS Device.
     * @param  string  $passTypeID This is the Apple Developer issued pass type name (eg: "pass.com.atmt.example").
     * @param  time $tag        This is the current time or the most recently updated_at time that the device has logged.
     * @return HTTP Response Code              This method returns the appropriate HTTP Response code given the logic and input.
     */
    public function updateWallet($deviceID, $passTypeID)
    {

        //Is it in our table of registered devices?
        if (iOS_Registration::where('ios_devices_id', $deviceID)->count() > 0) {
            //Yes, it's registered with our service.

            //Now grab all the passes to which this device is registered.

            $registered_serial_numbers = iOS_Registration::where('ios_devices_id', $deviceID)->where('pass_type_id', $passTypeID)->pluck('ios_passes_serial')->take(1);
            $registered_passes = iOS_Pass::where('serial_no', $registered_serial_numbers);
            $registered_passes_count = iOS_Pass::where('serial_no', $registered_serial_numbers)->count();


            //If there are passes that should be updated.
            if ($registered_passes_count > 0) {

                //Return a JSON formatted object.
                $response = response()->json(['lastUpdated' => '"' . time() . '"', 'serialNumbers' => $registered_serial_numbers], 200)->header('If-Modified-Since', Carbon\Carbon::now()->format('D, d M Y H:i:s \G\M\T'));
                return $response;
            } else {

                //No content to return.
                return response('No content', 204);
            }
        } else {
            //No, it's not registered with our service.
            return response('Not found', 404);
        }
    }

    /**
     * This method handles update notifications on behalf of APNs Server for a given device.
     * @param  string  $deviceID   The UUID generated by the Wallet application on an iOS Device.
     * @param  string  $passTypeID This is the Apple Developer issued pass type name (eg: "pass.com.atmt.example").
     * @param  time $tag        This is the current time or the most recently updated_at time that the device has logged.
     * @return HTTP Response Code              This method returns the appropriate HTTP Response code given the logic and input.
     */
    public function updateWalletTagged($deviceID, $passTypeID, $tag)
    {
        //Is it in our table of registered devices?
        if (iOS_Registration::where('ios_devices_id', $deviceID)->count() > 0) {
            //Yes, it's registered with our service.

            //Now grab all the passes to which this device is registered.
            $registered_serial_numbers = iOS_Registration::where('ios_devices_id', $deviceID)->where('pass_type_id', $passTypeID)->get('serial_no');
            if (isset($tag) && $tag != '') {
                //Tag is set and is not equal to a blank string.
                $registered_passes = iOS_Pass::where('serial_no', $registered_serial_numbers)->where('updated_at', '>=', $tag);
            } else {
                //Tag may not be set or is a blank string.
                $registered_passes = iOS_Pass::where('serial_no', $registered_serial_numbers);
            }

            //If there are passes that should be updated.
            if ($registered_passes > 0) {

                //Return a JSON formatted object.
                return Response::json(['lastUpdated' => time(), 'serialNumbers' => $registered_passes], 200);
            } else {

                //No content to return.
                return response('No content', 204);
            }
        } else {
            //No, it's not registered with our service.
            return response('Not found', 404);
        }
    }

    public function getWallet($passTypeID, $serial, Request $request)
    {
        if (iOS_Pass::where('serial_no', $serial)->where('passTypeID', $passTypeID)->where('authentication_token', substr($request->header('authorization'), 10))->first()) {
            if (file_exists('/home/forge/wavvve.io/public/business/'.$serial.'.pkpass')) {
                header('Content-Type: application/vnd.apple.pkpass');
                readfile('/home/forge/wavvve.io/public/business/'.$serial.'.pkpass');
            } else {
                return response('Not found', 404);
            }
        } else {
            return response('Unauthorized', 401);
        }
    }

    public function pubAccess($uuid, Pass $pass)
    {
        $currentTime = date('Y-m-d H:i:s');
        $customerPass = Pass::where('uuid', $uuid)->firstOrFail();
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
