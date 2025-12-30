<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'password' => bcrypt(Str::random(16)),
                'provider' => 'google',
                'provider_id' => $googleUser->id,
                'role' => 'student',
            ]
        );

        Auth::guard('web')->login($user);

        return redirect()->route('student.tests.index');
    }
}
