<x-layouts.guest>
    <div class="flex-1 flex flex-col items-center justify-center px-6 py-16 text-center">

        {{-- Logo / ornamen --}}
        <p class="font-script text-6xl text-[var(--color-primary)] mb-2">Wedding</p>
        <h1 class="font-serif text-2xl font-bold text-[var(--color-text)] mb-1">Invitation</h1>
        <p class="text-sm text-[var(--color-muted)] mb-10">Masukkan kode undangan untuk membuka undangan digitalmu</p>

        {{-- Form kode undangan --}}
        <form method="GET" action="#"
              onsubmit="event.preventDefault(); window.location='/invitation/' + this.code.value.toUpperCase()"
              class="w-full max-w-xs flex flex-col gap-3">

            <input
                type="text"
                name="code"
                maxlength="8"
                required
                placeholder="XXXXXXXX"
                class="w-full h-14 text-center rounded-input border border-[var(--color-border)]
                       bg-[var(--color-surface)] text-xl font-mono font-bold tracking-[0.3em]
                       text-[var(--color-text)] uppercase placeholder:normal-case
                       placeholder:tracking-normal placeholder:font-normal placeholder:text-base
                       placeholder:text-[var(--color-muted)]
                       focus:outline-none focus:border-[var(--color-primary)]
                       focus:ring-2 focus:ring-[var(--color-primary)]/20 transition-all"
            />

            <x-ui.btn type="submit" variant="primary" size="lg" :full="true">
                Buka Undangan
            </x-ui.btn>

        </form>

        {{-- Divider --}}
        <div class="flex items-center gap-3 w-full max-w-xs my-8">
            <div class="flex-1 h-px bg-[var(--color-border)]"></div>
            <span class="text-xs text-[var(--color-muted)]">atau</span>
            <div class="flex-1 h-px bg-[var(--color-border)]"></div>
        </div>

        <x-ui.btn href="{{ route('login') }}" variant="ghost" size="md">
            Login Admin Panel
        </x-ui.btn>

    </div>
</x-layouts.guest>
