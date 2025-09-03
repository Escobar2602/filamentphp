<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class ChatPersonal extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string $view = 'filament.pages.chat-personal';
    protected static ?string $title = 'Chat Personal';

    public $users;            // listado de usuarios
    public $selectedUserId;   // usuario con quien se chatea
    public $messages = [];
    public $newMessage = '';

    public function mount()
    {
        $this->users = User::where('id', '!=', Auth::id())->get(); // todos menos el actual
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        if (!$this->selectedUserId) return;

        $this->messages = ChatMessage::with(['sender', 'receiver'])
            ->where(function ($q) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $this->selectedUserId);
            })
            ->orWhere(function ($q) {
                $q->where('sender_id', $this->selectedUserId)
                  ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at')
            ->get();
    }

    public function sendMessage()
    {
        if (!$this->selectedUserId || !trim($this->newMessage)) return;

        ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->selectedUserId,
            'message' => $this->newMessage,
        ]);

        $this->newMessage = '';
        $this->loadMessages();
    }
}
