<x-filament-panels::page>
    <div class="flex justify-center mt-6">
        <div class="w-full max-w-2xl space-y-6">

            @foreach($publicaciones as $pub)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-5 transition hover:shadow-xl duration-300">

                    {{-- Usuario y fecha --}}
                    <div class="mb-3">
                        <p class="font-semibold text-gray-800 dark:text-gray-100 text-lg">
                            {{ $pub->user?->name ?? 'Usuario desconocido' }}
                        </p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">
                            {{ $pub->created_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- Descripción --}}
                    <p class="text-gray-700 dark:text-gray-200 text-base leading-relaxed">
                        {{ $pub->descripcion }}
                    </p>

                    {{-- Imagen --}}
                    @if($pub->imagen)
                        <img src="{{ Storage::url($pub->imagen) }}" 
                             class="mt-4 rounded-xl w-full object-cover shadow-sm">
                    @endif

                    {{-- Botones de acción --}}
                    <div class="flex space-x-6 mt-4 text-gray-500 dark:text-gray-400 text-sm">
                        <button class="flex items-center space-x-1 hover:text-blue-500 transition">
                            <span>👍</span>
                            <span>{{ $pub->likes->count() }} Like{{ $pub->likes->count() !== 1 ? 's' : '' }}</span>
                        </button>
                        <button class="flex items-center space-x-1 hover:text-gray-700 dark:hover:text-gray-200 transition">
                            <span>💬</span>
                            <span>{{ $pub->comentarios->count() }} Comentario{{ $pub->comentarios->count() !== 1 ? 's' : '' }}</span>
                        </button>
                    </div>

                    {{-- Comentarios --}}
                    @if($pub->comentarios->count() > 0)
                        <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-3 space-y-2 text-gray-600 dark:text-gray-300 text-sm">
                            @foreach($pub->comentarios as $coment)
                                <div class="flex gap-1">
                                    <strong class="text-gray-800 dark:text-gray-100">{{ $coment->user?->name ?? 'Anónimo' }}</strong>
                                    <span>{{ $coment->contenido }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            @endforeach

        </div>
    </div>
</x-filament-panels::page>
