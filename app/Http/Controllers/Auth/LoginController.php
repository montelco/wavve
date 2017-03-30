<?php

namespace Wavvve\Http\Controllers\Auth;

use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Wavvve\Jobs\Users\UserTracking;
use Wavvve\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (! $user->active) {
            Auth::logout();
            return redirect('/login')->withError('Please activate your account to continue. <a href="' . route('auth.activate.resend') . '?email=' . $user->email . '">Resend Email</a>');
        } else {
            if (! $user->subscribed) {
                return redirect('/plan')->withError('Please pick a subscription plan to continue.');
            } else {
                $this->dispatch(new UserTracking($user, Carbon::now()));
            }
        }
    }
}
