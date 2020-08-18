<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;

class MobileOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

       // return $next($request);
       $agent = new Agent();
       if (!$agent->isMobile()){
        return redirect(route('profile'));
       }else{
          return $next($request);
       }

    }
}
