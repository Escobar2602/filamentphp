<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Si no viene el código, enviamos al login de Microsoft
        if (!$request->has('code')) {
            return Socialite::driver('microsoft')->redirect();
        }

        try {
            $socialUser = Socialite::driver('microsoft')->user();
        } catch (InvalidStateException $e) {
            // Si falla el "state", reiniciamos la sesión y reintentamos
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return Socialite::driver('microsoft')->redirect();
        }

        // Crear o actualizar el usuario en base a su email
        $user = User::updateOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                // Contraseña dummy para cumplir con el fillable
                'password' => bcrypt(Str::random(16)),
            ]
        );

        // Loguear al usuario en Laravel
        Auth::login($user);
        $request->session()->regenerate();

        // Redirigir al dashboard de Filament
        return redirect('/dashboard/feed-publicaciones');
    }
}
