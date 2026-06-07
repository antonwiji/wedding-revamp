<x-layouts.guest>
    <div class="flex-1 flex flex-col">

        {{-- Hero Section --}}
        <div class="bg-[var(--color-primary)] text-white text-center px-6 py-14">
            <p class="text-sm uppercase tracking-widest opacity-80 mb-2">Undangan Pernikahan</p>
            <p class="font-script text-5xl mb-1">Budi & Ani</p>
            <p class="font-serif text-lg font-semibold mt-2">Budi Santoso & Ani Rahayu</p>
            <p class="text-sm opacity-75 mt-3">Sabtu, 17 Agustus 2026</p>
            <p class="text-sm opacity-75">Ballroom Hotel Mulia, Jakarta</p>
        </div>

        {{-- Info Tamu --}}
        <div class="px-5 -mt-5">
            <x-ui.card padding="p-5">
                <p class="text-xs text-[var(--color-muted)] uppercase tracking-widest mb-1">Kepada Yth.</p>
                <p class="text-xl font-bold text-[var(--color-text)]">{{ $guest->name }}</p>
                @if($guest->max_attendees > 1)
                    <p class="text-sm text-[var(--color-muted)] mt-0.5">beserta {{ $guest->max_attendees - 1 }} orang</p>
                @endif
                <div class="flex items-center gap-2 mt-3">
                    <span class="text-xs px-2 py-1 rounded-full bg-[var(--color-surface)] text-[var(--color-secondary)] font-medium">
                        {{ $guest->category->label() }}
                    </span>
                    <span class="font-mono text-xs text-[var(--color-muted)]">{{ $guest->invitation_code }}</span>
                </div>
            </x-ui.card>
        </div>

        {{-- Acara --}}
        <div class="px-5 mt-4">
            <x-ui.card padding="p-5">
                <p class="text-sm font-semibold text-[var(--color-text)] mb-3">📅 Detail Acara</p>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-[var(--color-muted)]">Tanggal</span>
                        <span class="font-medium text-[var(--color-text)]">Sabtu, 17 Agustus 2026</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[var(--color-muted)]">Waktu</span>
                        <span class="font-medium text-[var(--color-text)]">11.00 – 14.00 WIB</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[var(--color-muted)]">Tempat</span>
                        <span class="font-medium text-[var(--color-text)] text-right">Ballroom Hotel Mulia, Jakarta</span>
                    </div>
                </div>
            </x-ui.card>
        </div>

        {{-- RSVP --}}
        <div class="px-5 mt-4 pb-8">
            @if($guest->rsvp_status->value !== 'pending')
                <x-ui.card padding="p-5">
                    <div class="text-center">
                        <span class="text-4xl">
                            {{ $guest->rsvp_status->value === 'attending' ? '✅' : '❌' }}
                        </span>
                        <p class="text-md font-semibold text-[var(--color-text)] mt-2">RSVP Diterima</p>
                        <p class="text-sm text-[var(--color-muted)] mt-1">Status: {{ $guest->rsvp_status->label() }}</p>
                    </div>
                </x-ui.card>
            @else
                <livewire:guest.rsvp-form :guest="$guest" />
            @endif
        </div>

    </div>
</x-layouts.guest>
