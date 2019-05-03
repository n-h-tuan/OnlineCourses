<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\VerifyEmailException;

class VerifyEmail
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
            if(Auth::user()->email_verified_at == "")
                throw new VerifyEmailException();
            else 
                return $next($request);
        }
        return response()->json('Bạn chưa đăng nhập.');
    }
}
