<?php

namespace Wavvve\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Wavvve\Pass;
use Wavvve\Visitor;

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

    public function index(Pass $pass)
    {
        return view('editor.pass-manager')->with('passes', Pass::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(10));
    }

    public function dash(Pass $pass)
    {
        $newsFeed = Pass::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->take(3)->get();

        return view('dashboard')->with('newsFeed', $newsFeed);
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
            'barcode_value' => 'required|max:16',
            'coupon_full_background_image' => 'max:254',
            'strip_background_image' => 'max:254',
            'secondary_field' => 'max:255',
            'cashier_helper' => 'max:64',
            'design_number' => 'required|max:1',
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
        ]);

        return response()->json(Pass::where('id', $request->passID));
    }

    public function delete($id)
    {
        $deletePass = Pass::where('id', $id)->first();
        if ((int) $deletePass->user_id == (int) Auth::user()->id) {
            $deletePass = Pass::findOrFail($id);
            $deletePass->delete();

            return redirect()->route('manage');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function getPublish($id)
    {
        return view('editor.pass-publish')->with('pass', Pass::where('id', $id)->firstOrFail());
    }

    public function setPublish(Request $request, $id)
    {
        return Pass::where('id', $id)->update(['published' => $request->published]);
    }
}
