<x-admin-layout title="Daftar Tamu">
    <x-slot name="__topBarSlot">
        <a href="{{ route('admin.guests.create') }}"
           class="touch-target w-10 h-10 rounded-full bg-[var(--color-primary)] text-white flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </a>
    </x-slot>

    <livewire:admin.guest-table />
</x-admin-layout>
