<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Jenssegers\Agent\Agent;

class Step2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
								if(Auth::user())
								{
									$step = (Auth::user()->step2)? Auth::user()->step2: 0;
									// dd($step);
									$agent = new Agent();
									if(empty($step) && $step < 10 ){
										dd($step);
										if ($agent->isMobile()){
											return redirect(route('mStep2User'));
										}else{
											return redirect(route('step2User'));
										}
									} else {
										if($agent->isMobile()){
											return redirect(route('mProfile'));
										} else {
											return redirect(route('profile'));
										}
									}
								}
        return $next($request);
    }
}
