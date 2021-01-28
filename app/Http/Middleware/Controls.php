<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;


use Closure;

class Controls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($id)
    {

        $user = User::where('id' , $id)->first();
        dd($user);
       if ($user && $user->isAdmin() ){
            return $next($request);
        }else{
            // return redirect('/unauthorized');
            return $next($request);

        }


    }
}
