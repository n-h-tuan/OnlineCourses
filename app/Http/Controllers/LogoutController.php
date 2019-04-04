<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function logout()
    {
        Auth::logout();
        return \redirect('/');
    }
}
