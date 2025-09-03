@props([
    'fullHeight' => false,
])

@php
    use Filament\Pages\SubNavigationPosition;

    $subNavigation = $this->getCachedSubNavigation();
    $subNavigationPosition = $this->getSubNavigationPosition();
    $widgetData = $this->getWidgetData();
@endphp

<div
    {{
        $attributes->class([
            'fi-page bg-gray-50 dark:bg-gray-900 transition-colors duration-300',
            'h-full' => $fullHeight,
        ])
    }}
>
    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_START, scopes: $this->getRenderHookScopes()) }}

    <section
        @class([
            'flex flex-col gap-y-10 py-10 px-6 md:px-10',
            'h-full' => $fullHeight,
        ])
    >
        {{-- Encabezado --}}
        @if ($header = $this->getHeader())
            {{ $header }}
        @elseif ($heading = $this->getHeading())
            @php $subheading = $this->getSubheading(); @endphp

            <x-filament-panels::header
                :actions="$this->getCachedHeaderActions()"
                :breadcrumbs="filament()->hasBreadcrumbs() ? $this->getBreadcrumbs() : []"
                :heading="$heading"
                :subheading="$subheading"
                class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-6 border border-gray-200 dark:border-gray-700"
            >
                @if ($heading instanceof \Illuminate\Contracts\Support\Htmlable)
                    <x-slot name="heading">{{ $heading }}</x-slot>
                @endif
                @if ($subheading instanceof \Illuminate\Contracts\Support\Htmlable)
                    <x-slot name="subheading">{{ $subheading }}</x-slot>
                @endif
            </x-filament-panels::header>
        @endif

        {{-- Contenido + Subnavegación --}}
        <div
            @class([
                'flex flex-col gap-8',
                match ($subNavigationPosition) {
                    SubNavigationPosition::Start, SubNavigationPosition::End => 'md:flex-row md:items-start',
                    default => null,
                } => $subNavigation,
                'h-full' => $fullHeight,
            ])
        >
            {{-- Subnavegación lateral o superior --}}
            @if ($subNavigation)
                <div class="contents md:hidden">
                    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_SELECT_BEFORE, scopes: $this->getRenderHookScopes()) }}
                </div>

                <x-filament-panels::page.sub-navigation.select :navigation="$subNavigation" />

                <div class="contents md:hidden">
                    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_SELECT_AFTER, scopes: $this->getRenderHookScopes()) }}
                </div>

                @if ($subNavigationPosition === SubNavigationPosition::Start)
                    <x-filament-panels::page.sub-navigation.sidebar
                        :navigation="$subNavigation"
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-4"
                    />
                @endif

                @if ($subNavigationPosition === SubNavigationPosition::Top)
                    <x-filament-panels::page.sub-navigation.tabs
                        :navigation="$subNavigation"
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700"
                    />
                @endif
            @endif

            {{-- Contenedor principal --}}
            <div
                @class([
                    'grid flex-1 auto-cols-fr gap-y-8',
                    'h-full' => $fullHeight,
                ])
            >
                {{-- Widgets arriba --}}
                @if ($headerWidgets = $this->getVisibleHeaderWidgets())
                    <x-filament-widgets::widgets
                        :columns="$this->getHeaderWidgetsColumns()"
                        :data="$widgetData"
                        :widgets="$headerWidgets"
                        class="fi-page-header-widgets bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700"
                    />
                @endif

                {{-- Slot principal (contenido dinámico) --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md border border-gray-200 dark:border-gray-700">
                    {{ $slot }}
                </div>

                {{-- Widgets abajo --}}
                @if ($footerWidgets = $this->getVisibleFooterWidgets())
                    <x-filament-widgets::widgets
                        :columns="$this->getFooterWidgetsColumns()"
                        :data="$widgetData"
                        :widgets="$footerWidgets"
                        class="fi-page-footer-widgets bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700"
                    />
                @endif
            </div>

            {{-- Subnavegación derecha --}}
            @if ($subNavigation && $subNavigationPosition === SubNavigationPosition::End)
                <x-filament-panels::page.sub-navigation.sidebar
                    :navigation="$subNavigation"
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-4"
                />
            @endif
        </div>

        {{-- Footer opcional --}}
        @if ($footer = $this->getFooter())
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                {{ $footer }}
            </div>
        @endif
    </section>

    {{-- Acciones modales --}}
    @if (! ($this instanceof \Filament\Tables\Contracts\HasTable))
        <x-filament-actions::modals />
    @endif

    <x-filament-panels::unsaved-action-changes-alert />
</div>
