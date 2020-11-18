<?php

namespace App\Http\Middleware;

use Closure;

class Type
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
        if (auth()->user()->type == 1) {
            return redirect()->route('coachingdashboard');
        }elseif (auth()->user()->type == 0) {
            return redirect()->route('teacherdashboard');
        }
        return redirect('/')->with('status',"Not a user yet.");
    }
}
