<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Jenssegers\Agent\Agent;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            $agent = new Agent();
            if ($agent->isMobile()){
                return route('mHomepage'); 
                // dd('mobile login');
            }else{
                return route('login');
            }

            // return route('login');
        }
    }
}
