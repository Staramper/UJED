<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        switch ($role) {
            case 'admin':
                if (auth()->user()->role == 'admin')
                return $next($request);        
                break;

            case 'socio':
                if (auth()->user()->role == 'admin')
                return $next($request);        
                if (auth()->user()->role == 'socio')
                return $next($request);        
                break;

            // case 'user':
            //     if (auth()->user()->role == 'admin')
            //     return $next($request);        
            //     if (auth()->user()->role == 'socio')
            //     return $next($request);       
            //     if (auth()->user()->role == 'user')
            //     return $next($request);    
            //     break;
    
            default:
                return Redirect('/');
                break;
        }

        return Redirect('/');
    }
}
