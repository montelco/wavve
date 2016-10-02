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
}
