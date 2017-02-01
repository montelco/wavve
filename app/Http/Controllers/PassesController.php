<?php

namespace Wavvve\Http\Controllers;

use Auth;
use Carbon;
use Wavvve\Pass;
use Wavvve\User;
use Wavvve\Visitor;
use Wavvve\iOS_Registration;
use Wavvve\iOS_Pass;
use Illuminate\Http\Request;
use Passbook\Pass\Field;
use Passbook\Pass\Image;
use Passbook\Pass\Beacon;
use Passbook\PassFactory;
use Passbook\Pass\Barcode;
use Passbook\Pass\Structure;
use Passbook\Type\StoreCard;
use Passbook\Type\EventTicket;
use Wavvve\Jobs\Passes\ApplePushNotificationService;

class PassesController extends Controller
{

    /**
     * Require authentication middleware for all Pass interaction from console.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function analytics(Pass $pass)
    {
        return view('editor.pass-analytics')
            ->with(['visitors' => $this->displayTwentyFourHourActivity(),
                    'morrisData' => $this->displayAreaChart(),
                    'recent' => $this->displayRecentActivity(),
                    'totals' => $this->displayTotalsforPasses(), ]);
    }

    public function index(Pass $pass)
    {
        return view('editor.pass-manager')->with('passes', Pass::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(10));
    }

    public function dash(Pass $pass)
    {
        return view('dashboard')
            ->with([
                'newsFeed' => Pass::where('user_id', Auth::user()->id)
                    ->orderBy('updated_at', 'desc')
                    ->take(5)
                    ->get(),
                'visitors' => $this->displayTwentyFourHourActivity(),
            ]);
    }

    public function feed()
    {
        $newsFeed = Pass::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->take(4)->get();

        return $newsFeed;
    }

    public function scheduler(Pass $pass)
    {
        return view('editor.pass-manager')->with('passes', $pass->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get());
    }

    public function create(Request $request, Pass $pass)
    {
        $this->validate($request, [
            'title' => 'required|max:64',
            'primary_field' => 'required|max:255',
            'barcode_value' => 'max:16',
            'coupon_full_background_image' => 'max:254',
            'strip_background_image' => 'max:254',
            'secondary_field' => 'max:255',
            'cashier_helper' => 'max:64',
            'design_number' => 'required|max:1',
            'expiry' => 'date_format:"Y-m-d H:i:s"',
        ]);

        $newlyMintedPass = $request->user()->passes()->create([
            'title' => $request->title,
            'template_number' => $request->design_number,
            'primary_field' => $request->primary_field,
            'secondary_field' => $request->secondary_field,
            'barcode_value' => $request->barcode_value,
            'cashier_helper' => $request->cashier_helper,
            'strip_background_image' => $request->strip_background_image,
            'coupon_full_background_image' => $request->coupon_full_background_image,
            'expiry' => $request->expiry,
            'uuid' => str_random(7),
        ]);

        return response()->json($pass->with('user')->find($newlyMintedPass->id));
    }

    public function edit(Request $request, Pass $pass)
    {
        $this->validate($request, [
            'title' => 'required|max:64',
            'primary_field' => 'required|max:255',
            'barcode_value' => 'required|max:16',
            'secondary_field' => 'max:255',
            'cashier_helper' => 'max:64',
        ]);

        $updatedPass = Pass::where('id', $request->passID);
        $updatedPass->update(
            [
                'title' => $request->title,
                'primary_field' => $request->primary_field,
                'secondary_field' => $request->secondary_field,
                'barcode_value' => $request->barcode_value,
                'cashier_helper' => $request->cashier_helper,
            ]
        );

        return response()->json(Pass::where('id', $request->passID));
    }

    public function delete($id)
    {
        $deletePass = Pass::where('id', $id)->first();
        if ((int) $deletePass->user_id == (int) Auth::user()->id) {
            $deletePass = Pass::findOrFail($id);
            $deletePass->delete();

            return redirect('/passes/manage');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function getPublish($id)
    {
        return view('editor.pass-publish')->with('pass', Pass::where('id', $id)->firstOrFail());
    }

    public function displayRecentActivity()
    {
        return Visitor::all()->where('passes.user_id', Auth::user()->id)->sortByDesc('created_at')->take(7);
    }

    public function displayTotalsforPasses()
    {
        return Pass::where('user_id', Auth::user()->id)->withCount('visitors')->get()->sortByDesc('visitors_count')->take(5);
    }

    public function displayTwentyFourHourActivity()
    {
        return Pass::where('user_id', Auth::user()->id)->withCount(['visitors' => function ($query) {
            $query->where('created_at', '<=', Carbon\Carbon::now())->where('created_at', '>=', Carbon\Carbon::now()->subHours(24));
        }])->get()->sum('visitors_count');
    }

    public function displayAreaChart()
    {
        return Visitor::all()->where('passes.user_id', Auth::user()->id)->sortByDesc('created_at')->groupBy(function ($query) {
            return Carbon\Carbon::parse($query->created_at)->format('Y-m-d');
        })->take(7)->map(function ($total) {
            return ['views' => $total->count(), 'period' => Carbon\Carbon::parse($total['0']->created_at)->format('Y-m-d')];
        });
    }

    public function setPublish(Request $request, $id)
    {
        Pass::where('id', $id)->update(['published' => $request->published]);
        return $this->getWalletCompiledPass(Auth::user()->username);
        $this->dispatch(new ApplePushNotificationService());
    }

    public function getWalletCompiledPass($username)
    {
        $results = User::with(['passes' => function ($query) {
            $query->where('published', 1)->orderBy('updated_at', 'desc')->firstOrFail();
        }])->where('username', $username)->firstOrFail();

        define('P12_FILE', '/home/forge/wavvve.io/atmt.p12');
        define('P12_PASSWORD', '1234');
        define('WWDR_FILE', '/home/forge/wavvve.io/wwdr.pem');
        define('PASS_TYPE_IDENTIFIER', 'pass.com.atmt.wavvvetest2');
        define('TEAM_IDENTIFIER', '527AHA4RH7');
        define('ORGANIZATION_NAME', 'Wavvve® by ATMT');
        define('OUTPUT_PATH', '/home/forge/wavvve.io/public/business');
        define('ICON_FILE', '/home/forge/wavvve.io/public/background.png');

        // Create an event ticket
        $pass = new StoreCard($results->username, $results->name);
        $pass->setBackgroundColor('rgb(178, 215, 234)');
        //$pass->setLogoText('rgb(255,255,255)');
        $pass->setAuthenticationToken($results->apple_auth);
        $pass->setWebServiceURL('https://www.wavvve.io');
        $pass->setLogoText($results->name);
        $beacon = new Beacon('2b4fcf51-4eaa-446d-b24e-4d1b437f3840');
        $beacon->setMajor(0);
        $beacon->setMinor(0);
        $pass->addBeacon($beacon);

        // Create pass structure
        $structure = new Structure();

        // Add header field
        // if(isset($results->passes['0']->title)) {
        //     $header = new Field('title', $results->passes['0']->title);
        //     $structure->addHeaderField($header);
        // }

        // // Add primary field
        // if(isset($results->passes['0']->primary_field)) {
        //     $primary = new Field('description', $results->passes['0']->primary_field);
        //     $structure->addPrimaryField($primary);
        // }

        // Add back field
        if(isset($results->passes['0']->uuid)) {
            $backField = new Field('redirect', '<a href="https://www.wavvve.io/' . $results->passes['0']->uuid . '">' . $results->passes['0']->title . '</a>');
            $backField->setChangeMessage('A new pass is available. Check it out!');
            $structure->addBackField($backField);
        }

        // Add icon image
        $icon = new Image(ICON_FILE, 'background');
        $pass->addImage($icon);

        // Set pass structure
        $pass->setStructure($structure);

        // Add barcode
        // if(isset($results->passes['0']->barcode_value)) {
        //     $barcode = new Barcode(Barcode::TYPE_QR, $results->passes['0']->barcode_value);
        //     $pass->setBarcode($barcode);
        // }

        // Create pass factory instance
        $factory = new PassFactory(PASS_TYPE_IDENTIFIER, TEAM_IDENTIFIER, ORGANIZATION_NAME, P12_FILE, P12_PASSWORD, WWDR_FILE);
        $factory->setOutputPath(OUTPUT_PATH);
        $factory->package($pass);

        //Insert records as required to maintain.
        iOS_Pass::create([
            'passTypeID' => PASS_TYPE_IDENTIFIER,
            'authentication_token' => $results->apple_auth,
            'serial_no' => $username,
        ]);

        return PassFactory::serialize($pass);
    }
}
