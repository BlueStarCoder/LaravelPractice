<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use App\Services\SocialAccountService;

class LoginController extends Controller
{
    public function redirectToProvider() {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function handleProviderCallback(SocialAccountService $service) {
//         $user = Socialite::driver('facebook')->user();
//         
//         // $user->token;
//         
//         // OAuth Two Providers
//         // $token = $user->token;
// 
//         // OAuth One Providers
//         // $token = $user->token;
//         // $tokenSecret = $user->tokenSecret;
// 
//         // All Providers
//         $user->getId();
//         $user->getNickname();
//         $user->getName();
//         $user->getEmail();
//         $user->getAvatar();
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to('/home');
    }
}
