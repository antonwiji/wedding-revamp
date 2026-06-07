<x-admin-layout title="Edit Tamu" :back="route('admin.guests.index')">

    {{-- Kode Undangan --}}
    <x-ui.card padding="p-4">
        <p class="text-xs text-[var(--color-muted)] uppercase tracking-widest mb-1">Kode Undangan</p>
        <p class="font-mono text-xl font-bold text-[var(--color-primary)] tracking-widest">{{ $guest->invitation_code }}</p>
        <p class="text-xs text-[var(--color-muted)] mt-1">Link: {{ url('invitation/' . $guest->invitation_code) }}</p>
    </x-ui.card>

    <x-ui.card>
        <form method="POST" action="{{ route('admin.guests.update', $guest) }}" class="flex flex-col gap-4">
            @csrf @method('PUT')

            <x-ui.input-field
                label="Nama Lengkap"
                name="name"
                type="text"
                :value="old('name', $guest->name)"
                :error="$errors->first('name')"
                required
            />

            <div class="grid grid-cols-2 gap-3">
                <x-ui.input-field
                    label="No. HP"
                    name="phone"
                    type="tel"
                    :value="old('phone', $guest->phone)"
                />
                <x-ui.input-field
                    label="Email"
                    name="email"
                    type="email"
                    :value="old('email', $guest->email)"
                />
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-sm font-medium text-[var(--color-text)]">Kategori</label>
                <select name="category"
                        class="w-full h-12 px-4 rounded-input bg-[var(--color-surface)] border border-[var(--color-border)]
                               text-md text-[var(--color-text)] focus:outline-none focus:border-[var(--color-primary)]
                               focus:ring-2 focus:ring-[var(--color-primary)]/20 transition-all">
                    <option value="family"    @selected(old('category', $guest->category->value) === 'family')>👨‍👩‍👧 Keluarga</option>
                    <option value="friend"    @selected(old('category', $guest->category->value) === 'friend')>👫 Teman</option>
                    <option value="colleague" @selected(old('category', $guest->category->value) === 'colleague')>💼 Rekan Kerja</option>
                    <option value="vip"       @selected(old('category', $guest->category->value) === 'vip')>⭐ VIP</option>
                </select>
            </div>

            <x-ui.input-field
                label="Maks. Tamu"
                name="max_attendees"
                type="number"
                :value="old('max_attendees', $guest->max_attendees)"
                min="1"
                max="10"
                required
            />

            <div class="flex gap-3 pt-2">
                <x-ui.btn type="submit" variant="primary" size="md" :full="true">Perbarui</x-ui.btn>
                <x-ui.btn href="{{ route('admin.guests.index') }}" variant="secondary" size="md">Batal</x-ui.btn>
            </div>
        </form>
    </x-ui.card>

    {{-- Hapus tamu --}}
    <form method="POST" action="{{ route('admin.guests.destroy', $guest) }}"
          onsubmit="return confirm('Hapus tamu {{ $guest->name }}?')">
        @csrf @method('DELETE')
        <x-ui.btn type="submit" variant="danger" size="md" :full="true">🗑 Hapus Tamu</x-ui.btn>
    </form>

</x-admin-layout>
