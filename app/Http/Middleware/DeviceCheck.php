<?php

namespace App\Http\Middleware;
use Closure;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;

class DeviceCheck
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
       if ($agent->isMobile()){

        if(!Auth::check()){
          return redirect(route('mHomepage'));
        }else{
          return redirect(route('mProfile'));
        }
        
       }else{
          return $next($request);
       }

    }
}
