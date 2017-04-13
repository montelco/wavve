<?php

namespace Wavvve\Http\Controllers\Auth;

use Auth;
use Wavvve\User;
use Wavvve\ActivationToken;
use Illuminate\Http\Request;
use Wavvve\Http\Controllers\Controller;
use Wavvve\Events\UserRequestedActivationEmail;

class ActivationController extends Controller
{
    public function activate(ActivationToken $token)
    {
        $token->user()->update([
            'active' => true,
        ]);

        $token->delete();

        Auth::login($token->user);

        return redirect('/dashboard');
    }

    public function resend(Request $request)
    {
        $user = User::byEmail($request->email)->firstOrFail();

        if ($user->active) {
            return redirect('/dashboard');
        }

        event(new UserRequestedActivationEmail($user));

        return redirect('/login')->withInfo('Resent activation email.');
    }
}
