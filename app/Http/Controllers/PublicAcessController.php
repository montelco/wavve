<?php

namespace Wavvve\Http\Controllers;

use Wavvve\Pass;
use Wavvve\User;
use Passbook\Pass\Field;
use Passbook\Pass\Image;
use Passbook\Pass\Beacon;
use Passbook\PassFactory;
use Passbook\Pass\Barcode;
use Passbook\Pass\Structure;
use Passbook\Type\StoreCard;

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

    public function getWalletCompiledPass($username)
    {
        $results = User::with(['passes' => function ($query) {
            $query->orderBy('updated_at', 'desc')->first();
        }])->where('username', $username)->firstOrFail();

        define('P12_FILE', 'C:\keys\ATMT.p12');
        define('P12_PASSWORD', '1234');
        define('WWDR_FILE', 'C:\keys\wwdr.pem');
        define('PASS_TYPE_IDENTIFIER', 'pass.com.atmt.wavvvetest2');
        define('TEAM_IDENTIFIER', '527AHA4RH7');
        define('ORGANIZATION_NAME', 'Wavvve® by ATMT');
        define('OUTPUT_PATH', 'C:\passbook');
        define('ICON_FILE', 'C:\tpw.png');

        // Create an event ticket
        $pass = new StoreCard($results->username, $results->username);
        $pass->setBackgroundColor('rgb(234, 182, 73)');
        //$pass->setLogoText('rgb(255,255,255)');
        $pass->setAuthenticationToken('gPPx9M35dszXQzjG2cBOw4IEPAY8sFSV9ICqoBikLLYUq30GtFfuqJ8ykS8B');
        $pass->setWebServiceURL('https://www.wavvve.io');
        $pass->setLogoText($results->name);
        $beacon = new Beacon('2b4fcf51-4eaa-446d-b24e-4d1b437f3840');
        $beacon->setMajor(0);
        $beacon->setMinor(0);
        $pass->addBeacon($beacon);

        // Create pass structure
        $structure = new Structure();

        // Add header field
        if(isset($results->passes['0']->title)) {
            $header = new Field('title', $results->passes['0']->title);
            $structure->addHeaderField($header);
        }

        // // Add primary field
        if(isset($results->passes['0']->primary_field)) {
            $primary = new Field('description', $results->passes['0']->primary_field);
            $structure->addPrimaryField($primary);
        }

        // Add auxiliary field
        if(isset($results->passes['0']->uuid)) {
            $auxiliary = new Field('redirect', '<a href="https://www.wavvve.io/' . $results->passes['0']->uuid . '">View In Browser</a>');
            $structure->addAuxiliaryField($auxiliary);
        }
        
        // Add icon image
        $icon = new Image(ICON_FILE, 'icon');
        $pass->addImage($icon);

        // Set pass structure
        $pass->setStructure($structure);

        // Add barcode
        if(isset($results->passes['0']->barcode_value)) {
            $barcode = new Barcode(Barcode::TYPE_QR, $results->passes['0']->barcode_value);
            $pass->setBarcode($barcode);
        }

        // Create pass factory instance
        $factory = new PassFactory(PASS_TYPE_IDENTIFIER, TEAM_IDENTIFIER, ORGANIZATION_NAME, P12_FILE, P12_PASSWORD, WWDR_FILE);
        $factory->setOutputPath(OUTPUT_PATH);
        $factory->package($pass);

        return PassFactory::serialize($pass);
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
