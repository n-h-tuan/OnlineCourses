<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\isAdminException;

class isGiangVien
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
            if(Auth::user()->level_id != 3)
                return $next($request);
            else
                throw new isAdminException;        
        }
        return response()->json([
            'data'=>"Bạn chưa đăng nhập",
        ],401);
    }
}
