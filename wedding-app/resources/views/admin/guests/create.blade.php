<x-layouts.admin>
    <div class="max-w-2xl">
        <div class="mb-6 flex items-center gap-4">
            <a href="{{ route('admin.guests.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Tamu</h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('admin.guests.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400 @error('name') border-red-400 @enderror" />
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                        <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            <option value="family" @selected(old('category') === 'family')>Keluarga</option>
                            <option value="friend" @selected(old('category') === 'friend')>Teman</option>
                            <option value="colleague" @selected(old('category') === 'colleague')>Rekan Kerja</option>
                            <option value="vip" @selected(old('category') === 'vip')>VIP</option>
                        </select>
                        @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Maks. Tamu *</label>
                        <input type="number" name="max_attendees" value="{{ old('max_attendees', 2) }}" min="1" max="10"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400" />
                        @error('max_attendees') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-900 transition">
                        Simpan
                    </button>
                    <a href="{{ route('admin.guests.index') }}"
                       class="px-6 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
