<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\UserResource;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return response([
                'data' => new UserResource(Auth::user()),
            ]);
            // return redirect('http://localhost:8000/api/User/1/GiangVien');
        }
        return response()->json([
            'data' => "Email hoặc mật khẩu không đúng",
        ]);
    }
}
