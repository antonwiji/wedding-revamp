<x-layouts.admin>
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Tamu</h1>
        <a href="{{ route('admin.guests.create') }}"
           class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-gray-900 transition text-sm">
            + Tambah Tamu
        </a>
    </div>

    <livewire:admin.guest-table />
</x-layouts.admin>
