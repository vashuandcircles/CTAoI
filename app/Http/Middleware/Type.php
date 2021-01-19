<?php

namespace App\Http\Middleware;

use Closure;
use Razorpay\Api\Request;

class Type
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->type == 1) {
            return redirect()->route('coachingdashboard');
        }elseif (auth()->user()->type == 0) {
            return redirect()->route('teacherdashboard');
        }
        return redirect('/')->with('status',"Not a user yet.");
    }
}
