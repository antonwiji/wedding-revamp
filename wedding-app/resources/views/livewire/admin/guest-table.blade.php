<div class="flex flex-col gap-3">

    {{-- Search Bar --}}
    <div class="sticky top-[56px] z-30 bg-[var(--color-bg)] pb-2 -mx-4 px-4">
        <x-ui.input-field
            wire:model.live.debounce.300ms="search"
            type="search"
            placeholder="Cari nama tamu..."
        />
    </div>

    {{-- Filter Chips --}}
    <div class="flex gap-2 overflow-x-auto scroll-hidden pb-1 -mx-4 px-4">
        @foreach(['all' => 'Semua', 'pending' => 'Menunggu', 'attending' => 'Hadir', 'not_attending' => 'Tidak Hadir'] as $val => $label)
            <button wire:click="$set('filterStatus', '{{ $val === 'all' ? '' : $val }}')"
                    class="flex-shrink-0 h-8 px-4 rounded-full text-sm font-medium border transition-colors
                           {{ ($filterStatus === '' && $val === 'all') || $filterStatus === $val
                               ? 'bg-[var(--color-primary)] text-white border-transparent'
                               : 'bg-white text-[var(--color-muted)] border-[var(--color-border)]' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- List Tamu --}}
    @forelse($guests as $guest)
        <x-ui.guest-card :guest="$guest" />
    @empty
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <span class="text-4xl mb-3">🔍</span>
            <p class="text-md font-medium text-[var(--color-text)]">Tamu tidak ditemukan</p>
            <p class="text-sm text-[var(--color-muted)] mt-1">Coba ubah kata kunci pencarian</p>
        </div>
    @endforelse

    {{-- Pagination --}}
    <div class="mt-2">
        {{ $guests->links() }}
    </div>

</div>
