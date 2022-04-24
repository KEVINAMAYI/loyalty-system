<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    { 

        if(($request->user() == null) || ($request->user()->role !== 'Staff'))
        {    
            

          return redirect('/login');
             
        }
        else
        {
            return $next($request);
        }
        
    }
}