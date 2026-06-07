<div>
    <div class="bg-white rounded-t-3xl px-5 pt-2 pb-6 pb-safe">

        <div class="bottom-sheet-handle mb-5"></div>

        <h2 class="text-xl font-bold font-serif text-[var(--color-text)] mb-1">Konfirmasi Kehadiran</h2>
        <p class="text-sm text-[var(--color-muted)] mb-6">Halo <strong>{{ $guest->name }}</strong>, mohon konfirmasi kehadiranmu.</p>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-card text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pilihan Hadir/Tidak --}}
        <div class="grid grid-cols-2 gap-3 mb-5">
            <button wire:click="$set('status', 'attending')"
                    class="h-14 rounded-card border-2 flex items-center justify-center gap-2 font-semibold text-md transition-all btn-press
                           {{ $status === 'attending'
                               ? 'bg-green-50 border-green-500 text-green-700'
                               : 'bg-white border-[var(--color-border)] text-[var(--color-muted)]' }}">
                ✅ Hadir
            </button>
            <button wire:click="$set('status', 'not_attending')"
                    class="h-14 rounded-card border-2 flex items-center justify-center gap-2 font-semibold text-md transition-all btn-press
                           {{ $status === 'not_attending'
                               ? 'bg-red-50 border-red-400 text-red-700'
                               : 'bg-white border-[var(--color-border)] text-[var(--color-muted)]' }}">
                ❌ Tidak Hadir
            </button>
        </div>

        @if($status === 'attending')
        <div class="mb-4">
            <p class="text-sm font-medium text-[var(--color-text)] mb-2">
                Jumlah yang hadir <span class="text-[var(--color-muted)]">(maks. {{ $guest->max_attendees }})</span>
            </p>
            <div class="flex items-center gap-4">
                <button wire:click="decreaseAttendees"
                        class="touch-target w-11 h-11 rounded-full border-2 border-[var(--color-border)] text-xl font-bold text-[var(--color-text)]">
                    −
                </button>
                <span class="text-2xl font-bold text-[var(--color-text)] w-8 text-center">{{ $actualAttendees }}</span>
                <button wire:click="increaseAttendees"
                        class="touch-target w-11 h-11 rounded-full border-2 border-[var(--color-primary)] text-xl font-bold text-[var(--color-primary)]">
                    +
                </button>
            </div>
            @error('actualAttendees')
                <p class="text-xs text-[var(--color-danger)] mt-1">{{ $message }}</p>
            @enderror
        </div>
        @endif

        {{-- Pesan --}}
        <div class="mb-6">
            <p class="text-sm font-medium text-[var(--color-text)] mb-1.5">Pesan <span class="text-[var(--color-muted)]">(opsional)</span></p>
            <textarea wire:model="message" rows="3"
                      class="w-full rounded-input border border-[var(--color-border)] bg-[var(--color-surface)]
                             text-md text-[var(--color-text)] placeholder:text-[var(--color-muted)]
                             px-4 py-3 focus:outline-none focus:border-[var(--color-primary)] focus:ring-2
                             focus:ring-[var(--color-primary)]/20 resize-none transition-all"
                      placeholder="Semoga langgeng dan bahagia selalu..."></textarea>
        </div>

        <x-ui.btn wire:click="submit" variant="primary" size="lg" :full="true">
            <span wire:loading.remove>Kirim Konfirmasi</span>
            <span wire:loading>Mengirim...</span>
        </x-ui.btn>

    </div>
</div>
