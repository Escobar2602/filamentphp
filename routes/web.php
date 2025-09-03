<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Filament\Notifications\Notification;
use App\Models\User;

Route::get('/', function () {
    return redirect('/dashboard/login');
});

//ruta para poder entrar del login al dashboard de filament
Route::get('/store', [UserController::class, 'store']); 

Route::get('/probar-noti', function () {
    $user = User::first(); // Envía la notificación al primer usuario

    Notification::make()
        ->title('Notificación de prueba 🚀')
        ->body('Ahora sí está funcionando correctamente.')
        ->success()
        ->sendToDatabase($user);

    return 'Notificación enviada!';
});