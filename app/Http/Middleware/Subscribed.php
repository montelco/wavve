<?php

namespace Wavvve\Http\Middleware;

use Closure;

class Subscribed
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (! $request->user()->subscribed) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('plan');
            }
        }

        return $next($request);
    }
}
