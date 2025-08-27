<x-filament-panels::page>
    <div class="flex justify-center mt-6">
        <div class="w-full max-w-2xl space-y-6">

            @foreach($publicaciones as $pub)
                <div class="bg-white shadow-md rounded-xl p-5 transition hover:shadow-xl duration-200">
                    
                    {{-- Usuario y fecha --}}
                    <div class="flex items-center space-x-3 mb-3">
                        <span class="font-semibold text-gray-800">{{ $pub->user->name }}</span>
                        <span class="text-gray-400 text-sm">{{ $pub->created_at->diffForHumans() }}</span>
                    </div>

                    {{-- Descripción --}}
                    <p class="text-gray-700 text-base">{{ $pub->descripcion }}</p>

                    {{-- Imagen --}}
                    @if($pub->imagen)
                        <img src="{{ Storage::url($pub->imagen) }}" class="mt-4 rounded-lg w-full object-cover">
                    @endif

                    {{-- Botones de acción --}}
                    <div class="flex space-x-6 mt-4 text-gray-500 text-sm">
                        <button class="flex items-center space-x-1 hover:text-blue-500 transition">
                            <span>👍</span>
                            <span>{{ $pub->likes->count() }} Like{{ $pub->likes->count() !== 1 ? 's' : '' }}</span>
                        </button>
                        <button class="flex items-center space-x-1 hover:text-gray-700 transition">
                            <span>💬</span>
                            <span>{{ $pub->comentarios->count() }} Comentario{{ $pub->comentarios->count() !== 1 ? 's' : '' }}</span>
                        </button>
                    </div>

                    {{-- Comentarios --}}
                    @if($pub->comentarios->count() > 0)
                        <div class="mt-4 border-t pt-3 space-y-2 text-gray-600 text-sm">
                            @foreach($pub->comentarios as $coment)
                                <div>
                                    <strong>{{ $coment->user->name }}</strong>: {{ $coment->contenido }}
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            @endforeach

        </div>
    </div>
</x-filament-panels::page>
