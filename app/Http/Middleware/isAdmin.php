<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\isAdminException;

class isAdmin
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
        if(Auth::check())
        {
            if(Auth::user()->level_id != 1)
                throw new isAdminException;
            else
                return $next($request);
        }
        return response()->json("Bạn chưa đăng nhập");

        
    }
}
