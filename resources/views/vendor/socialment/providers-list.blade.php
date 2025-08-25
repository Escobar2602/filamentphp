@php
    $panelId = $panel->getId();
    $panelPath = $panel->getPath();
@endphp
<section class='filalite-panel flex flex-col gap-6 mt-4'>
    <div class="relative flex items-center">
        <div class="flex-grow  "></div>
        <!-- <span class="flex-shrink mx-4 text-gray-400 px-4">
            {{ config('socialment.view.prompt', 'Or Login Via') }}
        </span> -->
        <div class="flex-grow  "></div>
    </div>
    <div 
    x-data="{ loading: false }" 
    class='flex justify-center gap-x-28 p-4'
>
   @foreach ($providers as $providerName => $provider)
    <a 
        href="{{ route('socialment.redirect.panel', ['panelId' => $panelId, 'provider' => $providerName]) }}"
        x-data="{ loading: false }"
        @click.prevent="loading = true; window.location.href=$el.href;" 
        class="relative ring-2 ring-slate-700/50 hover:ring-slate-600/70 transition-all rounded-lg px-12 py-6 flex items-center justify-center text-lg font-bold"
    >
        <x-icon name="{{ $provider['icon'] }}" class='w-10 h-10' />
        <span>{{ $provider['label'] }}</span>

        <template x-if="loading">
            <div class="fixed inset-0 flex items-center justify-center bg-white/50 backdrop-blur-md z-50">
                <div class="loader"></div>
            </div>
        </template>
    </a>
@endforeach



</div>
</section>

<style>
    .loader {
  height: 15px;
  aspect-ratio: 4;
  --_g: no-repeat radial-gradient(farthest-side, #4319ec 90%, #3604ff);
  background:
    var(--_g) left,
    var(--_g) right;
  background-size: 25% 100%;
  display: grid;
}
.loader:before,
.loader:after {
  content: "";
  height: inherit;
  aspect-ratio: 1;
  grid-area: 1/1;
  margin: auto;
  border-radius: 50%;
  transform-origin: -100% 50%;
  background: #2600fff8;
  animation: l49 1s infinite linear;
}
.loader:after {
  transform-origin: 200% 50%;
  --s: -1;
  animation-delay: -0.5s;
}
@keyframes l49 {
  58%,
  100% {
    transform: rotate(calc(var(--s, 1) * 1turn));
  }
}

</style>
