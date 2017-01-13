<?php

namespace Wavvve\Http\Controllers;

use Auth;
use Carbon;
use Wavvve\Pass;
use Wavvve\User;
use Wavvve\Visitor;
use Illuminate\Http\Request;

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
        return Pass::where('id', $id)->update(['published' => $request->published]);
    }
}
