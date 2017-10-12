<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsAuthenticated
{
    private function verify_token($token)
    {
        throw new Exception('Not implemented');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // check that the session contains a valid token
        $is_authenticated = session()->has('accessToken')
            && session()->has('expirationTimestamp')
            && session('expirationTimestamp') > time();

        if(!$is_authenticated) {
            return redirect('login');
        }

        return $next($request);
    }
}
