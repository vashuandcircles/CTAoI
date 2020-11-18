<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if(auth()->user()->is_admin == 1){
            return $next($request);
        }
        if(auth()->user()->type == 1){
            return redirect('coachingdashboard');
        }
        if(auth()->user()->type == 0){
            return redirect('teacherdashboard');
        }
        if(auth()->user()->type == 2){
            return redirect('studentdashboard');
        }
        return back()->with('status',"You don't have admin access.");
    }
}
