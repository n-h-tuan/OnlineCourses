<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        
        // $request->headers->set('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQwZjM4MzY0MzM3Y2NkNzY4YmNmYjRlNzcxMzI5ZTYyM2U4NTQ0ZDI4NjgzNjM5MzJmZDhiMmZjYTg0MDZiMTE5YWU3ZTRmOWI2ZWU5MmViIn0.eyJhdWQiOiIzIiwianRpIjoiZDBmMzgzNjQzMzdjY2Q3NjhiY2ZiNGU3NzEzMjllNjIzZTg1NDRkMjg2ODM2MzkzMmZkOGIyZmNhODQwNmIxMTlhZTdlNGY5YjZlZTkyZWIiLCJpYXQiOjE1NTI1NTcxNTgsIm5iZiI6MTU1MjU1NzE1OCwiZXhwIjoxNTg0MTc5NTU4LCJzdWIiOiIxNyIsInNjb3BlcyI6W119.A87FKpdbSpRqgeLlvcfnx1BjmWNP6R_4Vq-vTItjSHTmZdbr1mSi5fD0LDXKQzO9rBOha7Pdiyp8HJQzkRfEgE_s_8Uf37nViFbjU-VkfrVTnqoOtOaRUPBlHaaK72iqteSgKcSlGKCbENc7OlT54qb6OW8DvCA19OW2q0A7DrxSG_nQqjl-wzs9EKHI_PjqsjenwMyugDc3wDisAV4frgpkN4Xkn18a2iPWmj0gntlGfWoYynfbCUB-GGr0HlvAkIlQwIUnnE2uJWx97w-SlRF4E0ejZdhC2TPGvkpVf_6uvZDCfcTIritbYWgsQvGWf2FP07sl8xutcrP5EPSO4umSNTnfdI0426zASyxskVbz_3hW6C2ysx5aStYbYJ4mmc0lVpqDnFq59ueeC-LFxkMyoxJgML-Rm2hCqjMMg5266qWcAxKgEaW_Z_AZ_V5HlWC1CbJ9F4ynOoktvCSAUXU9b-F0s8nrCPqc0r5ySEQcqQD8r1n6jDhoVHcsDMGv49pfLR7iSWaYEOf9U3-9AMnejiXogjqh-eakT6dA40CEVaUIbLhTsEu44fFRF9W3yuwEVn3x_V7zvxqsR3yoGqj9W9W_VJwDpCg8r2EXZPiR0k8XUZsHz87YgGldcLrop9Uhy4RZZixF00LHgSV8jq-vvvq33BPkCm8u8BEuj5I');
        // return $next($request);

        // $response = $next($request);
        // $response->headers->set('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQwZjM4MzY0MzM3Y2NkNzY4YmNmYjRlNzcxMzI5ZTYyM2U4NTQ0ZDI4NjgzNjM5MzJmZDhiMmZjYTg0MDZiMTE5YWU3ZTRmOWI2ZWU5MmViIn0.eyJhdWQiOiIzIiwianRpIjoiZDBmMzgzNjQzMzdjY2Q3NjhiY2ZiNGU3NzEzMjllNjIzZTg1NDRkMjg2ODM2MzkzMmZkOGIyZmNhODQwNmIxMTlhZTdlNGY5YjZlZTkyZWIiLCJpYXQiOjE1NTI1NTcxNTgsIm5iZiI6MTU1MjU1NzE1OCwiZXhwIjoxNTg0MTc5NTU4LCJzdWIiOiIxNyIsInNjb3BlcyI6W119.A87FKpdbSpRqgeLlvcfnx1BjmWNP6R_4Vq-vTItjSHTmZdbr1mSi5fD0LDXKQzO9rBOha7Pdiyp8HJQzkRfEgE_s_8Uf37nViFbjU-VkfrVTnqoOtOaRUPBlHaaK72iqteSgKcSlGKCbENc7OlT54qb6OW8DvCA19OW2q0A7DrxSG_nQqjl-wzs9EKHI_PjqsjenwMyugDc3wDisAV4frgpkN4Xkn18a2iPWmj0gntlGfWoYynfbCUB-GGr0HlvAkIlQwIUnnE2uJWx97w-SlRF4E0ejZdhC2TPGvkpVf_6uvZDCfcTIritbYWgsQvGWf2FP07sl8xutcrP5EPSO4umSNTnfdI0426zASyxskVbz_3hW6C2ysx5aStYbYJ4mmc0lVpqDnFq59ueeC-LFxkMyoxJgML-Rm2hCqjMMg5266qWcAxKgEaW_Z_AZ_V5HlWC1CbJ9F4ynOoktvCSAUXU9b-F0s8nrCPqc0r5ySEQcqQD8r1n6jDhoVHcsDMGv49pfLR7iSWaYEOf9U3-9AMnejiXogjqh-eakT6dA40CEVaUIbLhTsEu44fFRF9W3yuwEVn3x_V7zvxqsR3yoGqj9W9W_VJwDpCg8r2EXZPiR0k8XUZsHz87YgGldcLrop9Uhy4RZZixF00LHgSV8jq-vvvq33BPkCm8u8BEuj5I');
        // return $response;

        // $request->headers->set('Authorization', "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQwZjM4MzY0MzM3Y2NkNzY4YmNmYjRlNzcxMzI5ZTYyM2U4NTQ0ZDI4NjgzNjM5MzJmZDhiMmZjYTg0MDZiMTE5YWU3ZTRmOWI2ZWU5MmViIn0.eyJhdWQiOiIzIiwianRpIjoiZDBmMzgzNjQzMzdjY2Q3NjhiY2ZiNGU3NzEzMjllNjIzZTg1NDRkMjg2ODM2MzkzMmZkOGIyZmNhODQwNmIxMTlhZTdlNGY5YjZlZTkyZWIiLCJpYXQiOjE1NTI1NTcxNTgsIm5iZiI6MTU1MjU1NzE1OCwiZXhwIjoxNTg0MTc5NTU4LCJzdWIiOiIxNyIsInNjb3BlcyI6W119.A87FKpdbSpRqgeLlvcfnx1BjmWNP6R_4Vq-vTItjSHTmZdbr1mSi5fD0LDXKQzO9rBOha7Pdiyp8HJQzkRfEgE_s_8Uf37nViFbjU-VkfrVTnqoOtOaRUPBlHaaK72iqteSgKcSlGKCbENc7OlT54qb6OW8DvCA19OW2q0A7DrxSG_nQqjl-wzs9EKHI_PjqsjenwMyugDc3wDisAV4frgpkN4Xkn18a2iPWmj0gntlGfWoYynfbCUB-GGr0HlvAkIlQwIUnnE2uJWx97w-SlRF4E0ejZdhC2TPGvkpVf_6uvZDCfcTIritbYWgsQvGWf2FP07sl8xutcrP5EPSO4umSNTnfdI0426zASyxskVbz_3hW6C2ysx5aStYbYJ4mmc0lVpqDnFq59ueeC-LFxkMyoxJgML-Rm2hCqjMMg5266qWcAxKgEaW_Z_AZ_V5HlWC1CbJ9F4ynOoktvCSAUXU9b-F0s8nrCPqc0r5ySEQcqQD8r1n6jDhoVHcsDMGv49pfLR7iSWaYEOf9U3-9AMnejiXogjqh-eakT6dA40CEVaUIbLhTsEu44fFRF9W3yuwEVn3x_V7zvxqsR3yoGqj9W9W_VJwDpCg8r2EXZPiR0k8XUZsHz87YgGldcLrop9Uhy4RZZixF00LHgSV8jq-vvvq33BPkCm8u8BEuj5I");
        // return $next($request);
        $response = $next($request);
 
        // $response->header('Cache-Control', 'no-cache, private');
        // $response->header('Content-Type', 'text/html; charset=UTF-8');
        $response->headers->set('Access-Control-Allow-Origin' , '*');
$response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
$response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
        
        return $response;
        // return \response($next($request))->header('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQwZjM4MzY0MzM3Y2NkNzY4YmNmYjRlNzcxMzI5ZTYyM2U4NTQ0ZDI4NjgzNjM5MzJmZDhiMmZjYTg0MDZiMTE5YWU3ZTRmOWI2ZWU5MmViIn0.eyJhdWQiOiIzIiwianRpIjoiZDBmMzgzNjQzMzdjY2Q3NjhiY2ZiNGU3NzEzMjllNjIzZTg1NDRkMjg2ODM2MzkzMmZkOGIyZmNhODQwNmIxMTlhZTdlNGY5YjZlZTkyZWIiLCJpYXQiOjE1NTI1NTcxNTgsIm5iZiI6MTU1MjU1NzE1OCwiZXhwIjoxNTg0MTc5NTU4LCJzdWIiOiIxNyIsInNjb3BlcyI6W119.A87FKpdbSpRqgeLlvcfnx1BjmWNP6R_4Vq-vTItjSHTmZdbr1mSi5fD0LDXKQzO9rBOha7Pdiyp8HJQzkRfEgE_s_8Uf37nViFbjU-VkfrVTnqoOtOaRUPBlHaaK72iqteSgKcSlGKCbENc7OlT54qb6OW8DvCA19OW2q0A7DrxSG_nQqjl-wzs9EKHI_PjqsjenwMyugDc3wDisAV4frgpkN4Xkn18a2iPWmj0gntlGfWoYynfbCUB-GGr0HlvAkIlQwIUnnE2uJWx97w-SlRF4E0ejZdhC2TPGvkpVf_6uvZDCfcTIritbYWgsQvGWf2FP07sl8xutcrP5EPSO4umSNTnfdI0426zASyxskVbz_3hW6C2ysx5aStYbYJ4mmc0lVpqDnFq59ueeC-LFxkMyoxJgML-Rm2hCqjMMg5266qWcAxKgEaW_Z_AZ_V5HlWC1CbJ9F4ynOoktvCSAUXU9b-F0s8nrCPqc0r5ySEQcqQD8r1n6jDhoVHcsDMGv49pfLR7iSWaYEOf9U3-9AMnejiXogjqh-eakT6dA40CEVaUIbLhTsEu44fFRF9W3yuwEVn3x_V7zvxqsR3yoGqj9W9W_VJwDpCg8r2EXZPiR0k8XUZsHz87YgGldcLrop9Uhy4RZZixF00LHgSV8jq-vvvq33BPkCm8u8BEuj5I');
    }
}
