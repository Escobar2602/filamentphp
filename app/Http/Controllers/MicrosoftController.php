<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MicrosoftController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function callback()
    {
        $microsoftUser = Socialite::driver('microsoft')->user();

        $user = User::firstOrCreate(
            ['email' => $microsoftUser->getEmail()],
            ['name' => $microsoftUser->getName()]
        );

        Auth::login($user);

        return redirect()->intended('/'); // o a tu panel Filament
    }
}
