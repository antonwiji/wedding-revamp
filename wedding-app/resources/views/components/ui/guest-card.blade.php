@props(['guest'])

<div class="bg-white rounded-card shadow-card p-4 flex items-center gap-3">

    {{-- Avatar Inisial --}}
    <div class="w-11 h-11 rounded-full bg-[var(--color-border)] flex items-center justify-center flex-shrink-0">
        <span class="text-md font-bold text-[var(--color-secondary)]">
            {{ strtoupper(substr($guest->name, 0, 2)) }}
        </span>
    </div>

    {{-- Info --}}
    <div class="flex-1 min-w-0">
        <p class="text-md font-semibold text-[var(--color-text)] truncate">{{ $guest->name }}</p>
        <p class="text-sm text-[var(--color-muted)] truncate">{{ $guest->phone ?? $guest->email ?? '-' }}</p>
        <div class="flex items-center gap-2 mt-1">
            <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-[var(--color-surface)] text-[var(--color-secondary)]">
                {{ $guest->category->label() }}
            </span>
            <span class="text-xs font-medium px-2 py-0.5 rounded-full
                {{ $guest->rsvp_status->value === 'attending'     ? 'bg-green-100 text-green-700'     : '' }}
                {{ $guest->rsvp_status->value === 'not_attending' ? 'bg-red-100 text-red-700'         : '' }}
                {{ $guest->rsvp_status->value === 'pending'       ? 'bg-yellow-100 text-yellow-700'   : '' }}">
                {{ $guest->rsvp_status->label() }}
            </span>
        </div>
    </div>

    {{-- Tombol aksi --}}
    <a href="{{ route('admin.guests.edit', $guest) }}"
       class="touch-target w-10 h-10 rounded-full hover:bg-[var(--color-surface)] flex items-center justify-center flex-shrink-0 transition-colors">
        <svg class="w-4 h-4 text-[var(--color-muted)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </a>

</div>
