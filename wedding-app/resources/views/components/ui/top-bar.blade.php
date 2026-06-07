@props([
    'title' => '',
    'back'  => null,
])

<header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-[var(--color-border)] pt-safe">
    <div class="flex items-center justify-between px-4 h-14">

        {{-- Tombol Back --}}
        <div class="w-10">
            @if($back)
                <a href="{{ $back }}"
                   class="touch-target w-10 h-10 rounded-full hover:bg-brand-bg transition-colors">
                    <svg class="w-5 h-5 text-[var(--color-text)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif
        </div>

        {{-- Judul --}}
        <h1 class="text-md font-semibold text-[var(--color-text)] truncate">
            {{ $title }}
        </h1>

        {{-- Slot kanan (opsional) --}}
        <div class="w-10 flex justify-end">
            {{ $slot ?? '' }}
        </div>

    </div>
</header>
