<div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
    <h2 class="text-xl font-semibold text-stone-700 mb-6">Konfirmasi Kehadiran (RSVP)</h2>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="submit" class="space-y-5">
        <!-- Status kehadiran -->
        <div>
            <label class="block text-sm font-medium text-stone-600 mb-2">Apakah kamu bisa hadir?</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" wire:model="status" value="attending" class="text-stone-600" />
                    <span class="text-stone-700">Ya, saya hadir</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" wire:model="status" value="not_attending" class="text-stone-600" />
                    <span class="text-stone-700">Maaf, tidak bisa hadir</span>
                </label>
            </div>
            @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Jumlah yang hadir -->
        @if ($status === 'attending')
        <div>
            <label class="block text-sm font-medium text-stone-600 mb-2">
                Jumlah yang hadir (maks. {{ $guest->max_attendees }} orang)
            </label>
            <input
                type="number"
                wire:model="actual_attendees"
                min="1"
                max="{{ $guest->max_attendees }}"
                class="border border-stone-300 rounded-lg px-4 py-2 w-24 focus:outline-none focus:ring-2 focus:ring-stone-400"
            />
            @error('actual_attendees') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        @endif

        <!-- Pesan -->
        <div>
            <label class="block text-sm font-medium text-stone-600 mb-2">Ucapan / Pesan (opsional)</label>
            <textarea
                wire:model="message"
                rows="3"
                placeholder="Tulis ucapan untuk mempelai..."
                class="w-full border border-stone-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-stone-400 resize-none"
            ></textarea>
            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button
            type="submit"
            class="w-full bg-stone-700 text-white py-3 rounded-lg hover:bg-stone-800 transition font-medium"
            wire:loading.attr="disabled"
            wire:loading.class="opacity-75"
        >
            <span wire:loading.remove>Kirim RSVP</span>
            <span wire:loading>Mengirim...</span>
        </button>
    </form>
</div>
