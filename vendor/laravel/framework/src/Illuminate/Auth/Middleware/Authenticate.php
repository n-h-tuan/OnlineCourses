<?php

namespace Illuminate\Auth\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        // $this->headers->set('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQwZjM4MzY0MzM3Y2NkNzY4YmNmYjRlNzcxMzI5ZTYyM2U4NTQ0ZDI4NjgzNjM5MzJmZDhiMmZjYTg0MDZiMTE5YWU3ZTRmOWI2ZWU5MmViIn0.eyJhdWQiOiIzIiwianRpIjoiZDBmMzgzNjQzMzdjY2Q3NjhiY2ZiNGU3NzEzMjllNjIzZTg1NDRkMjg2ODM2MzkzMmZkOGIyZmNhODQwNmIxMTlhZTdlNGY5YjZlZTkyZWIiLCJpYXQiOjE1NTI1NTcxNTgsIm5iZiI6MTU1MjU1NzE1OCwiZXhwIjoxNTg0MTc5NTU4LCJzdWIiOiIxNyIsInNjb3BlcyI6W119.A87FKpdbSpRqgeLlvcfnx1BjmWNP6R_4Vq-vTItjSHTmZdbr1mSi5fD0LDXKQzO9rBOha7Pdiyp8HJQzkRfEgE_s_8Uf37nViFbjU-VkfrVTnqoOtOaRUPBlHaaK72iqteSgKcSlGKCbENc7OlT54qb6OW8DvCA19OW2q0A7DrxSG_nQqjl-wzs9EKHI_PjqsjenwMyugDc3wDisAV4frgpkN4Xkn18a2iPWmj0gntlGfWoYynfbCUB-GGr0HlvAkIlQwIUnnE2uJWx97w-SlRF4E0ejZdhC2TPGvkpVf_6uvZDCfcTIritbYWgsQvGWf2FP07sl8xutcrP5EPSO4umSNTnfdI0426zASyxskVbz_3hW6C2ysx5aStYbYJ4mmc0lVpqDnFq59ueeC-LFxkMyoxJgML-Rm2hCqjMMg5266qWcAxKgEaW_Z_AZ_V5HlWC1CbJ9F4ynOoktvCSAUXU9b-F0s8nrCPqc0r5ySEQcqQD8r1n6jDhoVHcsDMGv49pfLR7iSWaYEOf9U3-9AMnejiXogjqh-eakT6dA40CEVaUIbLhTsEu44fFRF9W3yuwEVn3x_V7zvxqsR3yoGqj9W9W_VJwDpCg8r2EXZPiR0k8XUZsHz87YgGldcLrop9Uhy4RZZixF00LHgSV8jq-vvvq33BPkCm8u8BEuj5I');
        // $response = $next($request);
        // $response->headers->set('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQwZjM4MzY0MzM3Y2NkNzY4YmNmYjRlNzcxMzI5ZTYyM2U4NTQ0ZDI4NjgzNjM5MzJmZDhiMmZjYTg0MDZiMTE5YWU3ZTRmOWI2ZWU5MmViIn0.eyJhdWQiOiIzIiwianRpIjoiZDBmMzgzNjQzMzdjY2Q3NjhiY2ZiNGU3NzEzMjllNjIzZTg1NDRkMjg2ODM2MzkzMmZkOGIyZmNhODQwNmIxMTlhZTdlNGY5YjZlZTkyZWIiLCJpYXQiOjE1NTI1NTcxNTgsIm5iZiI6MTU1MjU1NzE1OCwiZXhwIjoxNTg0MTc5NTU4LCJzdWIiOiIxNyIsInNjb3BlcyI6W119.A87FKpdbSpRqgeLlvcfnx1BjmWNP6R_4Vq-vTItjSHTmZdbr1mSi5fD0LDXKQzO9rBOha7Pdiyp8HJQzkRfEgE_s_8Uf37nViFbjU-VkfrVTnqoOtOaRUPBlHaaK72iqteSgKcSlGKCbENc7OlT54qb6OW8DvCA19OW2q0A7DrxSG_nQqjl-wzs9EKHI_PjqsjenwMyugDc3wDisAV4frgpkN4Xkn18a2iPWmj0gntlGfWoYynfbCUB-GGr0HlvAkIlQwIUnnE2uJWx97w-SlRF4E0ejZdhC2TPGvkpVf_6uvZDCfcTIritbYWgsQvGWf2FP07sl8xutcrP5EPSO4umSNTnfdI0426zASyxskVbz_3hW6C2ysx5aStYbYJ4mmc0lVpqDnFq59ueeC-LFxkMyoxJgML-Rm2hCqjMMg5266qWcAxKgEaW_Z_AZ_V5HlWC1CbJ9F4ynOoktvCSAUXU9b-F0s8nrCPqc0r5ySEQcqQD8r1n6jDhoVHcsDMGv49pfLR7iSWaYEOf9U3-9AMnejiXogjqh-eakT6dA40CEVaUIbLhTsEu44fFRF9W3yuwEVn3x_V7zvxqsR3yoGqj9W9W_VJwDpCg8r2EXZPiR0k8XUZsHz87YgGldcLrop9Uhy4RZZixF00LHgSV8jq-vvvq33BPkCm8u8BEuj5I');
        // return $response;

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        //
    }
}
