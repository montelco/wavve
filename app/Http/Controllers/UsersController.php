<?php

namespace Wavvve\Http\Controllers;

use Auth;
use Wavvve\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setLogo(User $user)
    {
        // Put that logic here!
    }

    public function updateSettings(Request $request, User $user, Auth $auth)
    {
        $this->validate($request, [
            'facebook' => 'required|max:24',
            'instagram' => 'required|max:24',
            'twitter' => 'required|max:14',
            'website' => 'max:255',
            'description' => 'max:250',
            'name' => 'max:32',
            'username' => 'max:36',
        ]);

        $updatedUser = User::where('id', Auth::user()->id);
        $updatedUser->update(
            [
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'website' => $request->website,
                'description' => $request->description,
                'name' => $request->name,
                'username' => $request->username,
            ]
        );

        return response()->json(null, 201);
    }
}
