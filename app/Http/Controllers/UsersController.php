<?php

namespace Wavvve\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Wavvve\User;


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
    public function getWebsite(User $user)
    {
    	echo '<a href="' . User::where('id', Auth::user()->id)->pluck('website')['0']  . '">Poop Face</a>';
    }

    public function setWebsite(User $user)
    {
        // Put that shiiiiit here.
    }
}
