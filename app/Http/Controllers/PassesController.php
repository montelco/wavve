<?php

namespace Wavvve\Http\Controllers;
use Illuminate\Http\Request;
use Wavvve\Http\Requests;
use Auth;
use Wavvve\Pass;

class PassesController extends Controller
{
    /**
     * Require authentication middleware for all Pass interaction from console.
     * @return void
     * 
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Pass $pass){
        $allPassesForUser = $pass->all()->where('user_id', Auth::user()->id);
        return view('editor.pass-manager')->with('passes', $allPassesForUser);
    }

    public function dash(Pass $pass){
        $newsFeed = Pass::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->take(3)->get();
        return view('dashboard')->with('newsFeed', $newsFeed);
    }

    public function feed(){
        $newsFeed = Pass::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->take(4)->get();
        return $newsFeed;
    }

    public function create(Request $request, Pass $pass){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-+';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = 8;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $this->validate($request, [
            'title' => 'required|max:64',
            'primary_field' => 'required|max:255',
            'barcode_value' => 'required|max:16',
            'coupon_full_background_image' => 'max:254',
            'strip_background_image' => 'max:254',
            'secondary_field' => 'max:255',
            'cashier_helper' => 'max:64',
            'design_number' => 'required|max:1'
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
            'uuid' => $randomString,
        ]);

        return response()->json($pass->with('user')->find($newlyMintedPass->id));
    }
    public function edit(Request $request, Pass $pass){
        $this->validate($request, [
            'title' => 'required|max:64',
            'primary_field' => 'required|max:255',
            'barcode_value' => 'required|max:16',
            'coupon_full_background_image' => 'max:254',
            'strip_background_image' => 'max:254',
            'secondary_field' => 'max:255',
            'cashier_helper' => 'max:64',
        ]);

        $updatedPass = Pass::where('id', $request->passID);
        $updatedPass->update(
            array(
                'title' => $request->title,
                'primary_field' => $request->primary_field,
                'secondary_field' => $request->secondary_field,
                'barcode_value' => $request->barcode_value,
                'cashier_helper' => $request->cashier_helper,
                'coupon_full_background_image' => $request->coupon_full_background_image,
        ));

        return response()->json(Pass::where('id', $request->passID));
    }

    public function delete($id){
        $deletePass = Pass::where('id', $id)->first();
        if((int)$deletePass->user_id == (int)Auth::user()->id){
            $deletePass = Pass::findOrFail($id);
            $deletePass->delete();
            return redirect()->route('manage');
        } else{
            return redirect()->route('dashboard');
        }
    }
}
