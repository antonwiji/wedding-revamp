<div>
    <!-- Filter & Search -->
    <div class="flex flex-wrap gap-4 mb-6">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari nama atau kode undangan..."
            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400"
        />
        <select wire:model.live="filterStatus" class="border border-gray-300 rounded-lg px-4 py-2">
            <option value="">Semua Status</option>
            <option value="pending">Menunggu</option>
            <option value="attending">Hadir</option>
            <option value="not_attending">Tidak Hadir</option>
        </select>
        <select wire:model.live="filterCategory" class="border border-gray-300 rounded-lg px-4 py-2">
            <option value="">Semua Kategori</option>
            <option value="family">Keluarga</option>
            <option value="friend">Teman</option>
            <option value="colleague">Rekan Kerja</option>
            <option value="vip">VIP</option>
        </select>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Kode</th>
                    <th class="px-6 py-3 text-left">Kategori</th>
                    <th class="px-6 py-3 text-left">Status RSVP</th>
                    <th class="px-6 py-3 text-left">Maks. Tamu</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($guests as $guest)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $guest->name }}</td>
                    <td class="px-6 py-4 font-mono text-gray-500">{{ $guest->invitation_code }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $guest->category->label() }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($guest->rsvp_status->value === 'attending') bg-green-100 text-green-700
                            @elseif($guest->rsvp_status->value === 'not_attending') bg-red-100 text-red-700
                            @else bg-yellow-100 text-yellow-700 @endif">
                            {{ $guest->rsvp_status->label() }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $guest->max_attendees }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.guests.edit', $guest) }}"
                               class="text-blue-600 hover:text-blue-800 text-xs">Edit</a>
                            <form method="POST" action="{{ route('admin.guests.destroy', $guest) }}"
                                  onsubmit="return confirm('Hapus tamu ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada data tamu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $guests->links() }}
    </div>
</div>
