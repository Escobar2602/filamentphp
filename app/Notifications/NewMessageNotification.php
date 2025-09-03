<?php

namespace App\Notifications;

use App\Models\ChatMessage;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification as BaseNotification;

class NewMessageNotification extends BaseNotification implements ShouldQueue
{
    use Queueable;

    protected $message;

    public function __construct(ChatMessage $message)
    {
        $this->message = $message;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => $this->message->message,
            'sender'  => $this->message->sender->name ?? 'Usuario desconocido',
            'url'     => route('filament.admin.resources.chat.index'), // ajusta a tu ruta de chat
        ];
    }

    public function toFilament(): void
    {
        Notification::make()
            ->title('Nuevo mensaje de ' . ($this->message->sender->name ?? 'Usuario'))
            ->body($this->message->message)
            ->success()
            ->sendToDatabase($this->message->receiver);
    }
}
