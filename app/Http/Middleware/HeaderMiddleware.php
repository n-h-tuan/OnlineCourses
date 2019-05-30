<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class HeaderMiddleware
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
        // return $response;
        // return $next($request)
        // ->header('Access-Control-Allow-Origin' , '*')
        // ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
        // ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With, Application')
        // ->header('Access-Control-Allow-Credentials','true')
        // ->header('X-Content-Type-Options', 'nosniff');

        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin' , '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With, Application');
        $response->headers->set('Access-Control-Allow-Credentials','true');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        return $response;
    }
}
