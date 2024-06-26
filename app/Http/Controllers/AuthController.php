<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('microsoft')->user();
        return redirect('/default');
    }

}
