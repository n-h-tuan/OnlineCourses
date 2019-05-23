<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\UserResource;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\Exceptions\SocialLoginException;


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
        return response()->json("Email hoặc mật khẩu không đúng");
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        // return response()->json($user);
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return response()->json([
            'data' => new UserResource($authUser),
        ]);
        // return redirect($this->redirectTo);
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        $checkUser = User::where('email', $user->email)->first();
        if($checkUser)
            throw new SocialLoginException();
        return $this->createUser($user, $provider);
    }

    public function createUser($user, $provider)
    {
        $newUser = User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'HinhAnh'  => $user->avatar,
            'email_verified_at' => new \DateTime(),
            'provider' => $provider,
            'password' => bcrypt(str_random(10)),
            'provider_id' => $user->id
        ]);
        $tokenResult = $newUser->createToken('Personal Access Token'); 
        $api_token = $tokenResult->accessToken;
        $token_type = 'Bearer';
        $newUser->api_token = $api_token;
        $newUser->token_type = $token_type;
        
        $newUser->save();
        return $newUser;
    }
    public function NhanThongTinGoogleUser (Request $request)
    {
        // Nhận name, email, HinhAnh, provider, provider_id
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|email',
                'HinhAnh' => 'required',
                'provider'=>'required',
                'provider_id'=>'required',
            ],
            []
        );
        $authUser = User::where('provider_id', $request->provider_id)->first();
        if ($authUser) {
            return response()->json([
                'data'=> new UserResource($authUser),
            ],200);
        }
        $checkUser = User::where('email', $request->email)->first();
        if($checkUser)
            throw new SocialLoginException();
        $newUser = $this->TaoUser($request);
        return response()->json([
            'data'=> new UserResource($newUser),
        ],200);
    }
    public function TaoUser(Request $request)
    {
        $newUser = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'HinhAnh'  => $request->HinhAnh,
            'email_verified_at' => new \DateTime(),
            'provider' => $request->provider,
            'password' => bcrypt(str_random(10)),
            'provider_id' => $request->provider_id
        ]);
        $tokenResult = $newUser->createToken('Personal Access Token'); 
        $api_token = $tokenResult->accessToken;
        $token_type = 'Bearer';
        $newUser->api_token = $api_token;
        $newUser->token_type = $token_type;
        
        $newUser->save();
        return $newUser;
    }

}
