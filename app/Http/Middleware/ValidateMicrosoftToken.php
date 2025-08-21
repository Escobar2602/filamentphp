<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateMicrosoftToken
{
    public function handle(Request $request, Closure $next): Response
    {

        
        $user = $request->user();
        
        if (!$user || !$user->microsoft_token) {
            return redirect()->route('login')->with('error', 'Token de Microsoft requerido');
        }
        
     
        
        return $next($request);
    }
}