<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;

class ChatController extends Controller
{
   public function sendMessage(Request $request)
{
    $message = ChatMessage::create([
        'sender_id'   => auth()->id(),
        'receiver_id' => $request->receiver_id,
        'message'     => $request->message,
    ]);

    // Buscar receptor
    $receiver = User::find($request->receiver_id);

    // Enviar notificación a la campana de Filament
    Notification::make()
        ->title('Nuevo mensaje de ' . auth()->user()->name)
        ->body($message->message)
        ->success()
        ->sendToDatabase($receiver);

    return response()->json(['success' => true, 'message' => $message]);
}
}
