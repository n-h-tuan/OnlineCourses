<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\Http\Resources\User\UserResource;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level_id = 3;
        $user->save();

        $tokenResult = $user->createToken('Personal Access Token'); 
        $api_token = $tokenResult->accessToken;
        $token_type = 'Bearer';
        $user->api_token = $api_token;
        $user->token_type = $token_type;

        $this->createAPI($request, $user);

        return response([
            'data' => new UserResource($user),
        ],200);

    }

    public function createAPI(RegisterRequest $request, User $user)
    {
        $tokenResult = $user->createToken('Personal Access Token'); 
        $api_token = $tokenResult->accessToken;
        $token_type = 'Bearer';
        $user->api_token = $api_token;
        $user->token_type = $token_type;
        $user->save();
    }
}
