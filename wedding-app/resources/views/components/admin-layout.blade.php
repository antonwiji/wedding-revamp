@props(['title' => 'Admin', 'back' => null])

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#b5977a">
    <title>{{ $title }} — {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>

    <x-ui.app-shell>

        {{-- Top Bar --}}
        <x-ui.top-bar :title="$title" :back="$back" />

        {{-- Flash message --}}
        @if(session('success'))
            <div class="mx-4 mt-3 p-3 bg-green-50 border border-green-200 rounded-card text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Konten --}}
        <main class="flex-1 overflow-y-auto scroll-hidden bg-[var(--color-bg)]">
            <div class="p-4 pb-24 flex flex-col gap-4">
                {{ $slot }}
            </div>
        </main>

        {{-- Bottom Navigation --}}
        <x-ui.bottom-nav :items="[
            ['label' => 'Dashboard', 'icon' => '🏠', 'url' => route('admin.dashboard'),    'match' => 'admin'],
            ['label' => 'Tamu',      'icon' => '👥', 'url' => route('admin.guests.index'), 'match' => 'admin/guests*'],
            ['label' => 'Statistik', 'icon' => '📊', 'url' => route('admin.statistics'),   'match' => 'admin/statistics*'],
            ['label' => 'Setelan',   'icon' => '⚙️',  'url' => route('admin.settings'),     'match' => 'admin/settings*'],
        ]" />

    </x-ui.app-shell>

    @livewireScripts
</body>
</html>
