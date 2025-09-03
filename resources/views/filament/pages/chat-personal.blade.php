<x-filament-panels::page>
    <div class="flex h-[70vh] border rounded-xl shadow-md overflow-hidden">

        {{-- Lista de usuarios --}}
        <div class="w-1/4 border-r bg-gray-100 dark:bg-gray-800 overflow-y-auto">
            <h3 class="p-3 font-bold text-gray-700 dark:text-white">Usuarios</h3>
            @foreach($this->users as $user)
                <button wire:click="selectUser({{ $user->id }})"
                    class="w-full text-left px-3 py-2 hover:bg-blue-100 dark:hover:bg-blue-700 {{ $selectedUserId === $user->id ? 'bg-blue-200 dark:bg-blue-600' : '' }}">
                    {{ $user->name }}
                </button>
            @endforeach
        </div>

        {{-- Conversación --}}
        <div class="flex flex-col flex-1">
            @if($selectedUserId)
                <div class="flex-1 p-4 space-y-3 overflow-y-auto bg-gray-50 dark:bg-gray-900" wire:poll.5s="loadMessages">
                    @foreach($this->messages as $msg)
                        <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div
                                class="max-w-xs px-3 py-2 rounded-2xl 
                        {{ $msg->sender_id === auth()->id() ? 'bg-blue-600 text-black' : 'bg-gray-200 dark:bg-gray-700 dark:text-white' }}">
                                <p class="text-sm">{{ $msg->message }}</p>
                                <span class="text-[10px] block mt-1 opacity-70">
                                    {{ $msg->sender->name }} • {{ $msg->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Input de mensaje --}}
                <form wire:submit.prevent="sendMessage"
                    class="flex items-center gap-2 p-3 border-t bg-white dark:bg-gray-800">
                    <input type="text" wire:model.defer="newMessage"
                        class="flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:border-blue-400 dark:bg-gray-900 dark:text-white"
                        placeholder="Escribe un mensaje..." />
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Enviar
                    </button>
                </form>
            @else
                <div class="flex-1 flex items-center justify-center text-gray-500 dark:text-gray-400">
                    Selecciona un usuario para chatear
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>