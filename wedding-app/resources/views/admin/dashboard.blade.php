<x-admin-layout title="Dashboard">

    {{-- Greeting --}}
    <div>
        <p class="text-sm text-[var(--color-muted)]">Selamat datang 👋</p>
        <h2 class="text-xl font-bold font-serif text-[var(--color-text)]">Wedding Dashboard</h2>
    </div>

    {{-- Statistik Grid --}}
    <div class="grid grid-cols-2 gap-3">
        <x-ui.stat-card label="Total Tamu"  :value="$stats['total']"         icon="👥" color="primary" />
        <x-ui.stat-card label="Hadir"       :value="$stats['attending']"      icon="✅" color="success" />
        <x-ui.stat-card label="Tidak Hadir" :value="$stats['not_attending']"  icon="❌" color="danger"  />
        <x-ui.stat-card label="Menunggu"    :value="$stats['pending']"        icon="⏳" color="warning" />
    </div>

    {{-- Tamu Terbaru --}}
    <div>
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-md font-semibold text-[var(--color-text)]">Tamu Terbaru</h3>
            <x-ui.btn href="{{ route('admin.guests.index') }}" variant="ghost" size="sm">Lihat Semua</x-ui.btn>
        </div>
        <div class="flex flex-col gap-2">
            @foreach($recentGuests as $guest)
                <x-ui.guest-card :guest="$guest" />
            @endforeach
        </div>
    </div>

</x-admin-layout>
