<x-admin-layout title="Tambah Tamu" :back="route('admin.guests.index')">

    <x-ui.card>
        <form method="POST" action="{{ route('admin.guests.store') }}" class="flex flex-col gap-4">
            @csrf

            <x-ui.input-field
                label="Nama Lengkap"
                name="name"
                type="text"
                :value="old('name')"
                :error="$errors->first('name')"
                required
                placeholder="Contoh: Budi Santoso"
            />

            <div class="grid grid-cols-2 gap-3">
                <x-ui.input-field
                    label="No. HP"
                    name="phone"
                    type="tel"
                    :value="old('phone')"
                    placeholder="08xx"
                />
                <x-ui.input-field
                    label="Email"
                    name="email"
                    type="email"
                    :value="old('email')"
                    placeholder="email@..."
                />
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-sm font-medium text-[var(--color-text)]">Kategori <span class="text-[var(--color-danger)]">*</span></label>
                <select name="category"
                        class="w-full h-12 px-4 rounded-input bg-[var(--color-surface)] border border-[var(--color-border)]
                               text-md text-[var(--color-text)] focus:outline-none focus:border-[var(--color-primary)]
                               focus:ring-2 focus:ring-[var(--color-primary)]/20 transition-all">
                    <option value="family"    @selected(old('category') === 'family')>👨‍👩‍👧 Keluarga</option>
                    <option value="friend"    @selected(old('category') === 'friend')>👫 Teman</option>
                    <option value="colleague" @selected(old('category') === 'colleague')>💼 Rekan Kerja</option>
                    <option value="vip"       @selected(old('category') === 'vip')>⭐ VIP</option>
                </select>
            </div>

            <x-ui.input-field
                label="Maks. Tamu"
                name="max_attendees"
                type="number"
                :value="old('max_attendees', 2)"
                min="1"
                max="10"
                required
            />

            <div class="flex gap-3 pt-2">
                <x-ui.btn type="submit" variant="primary" size="md" :full="true">Simpan Tamu</x-ui.btn>
                <x-ui.btn href="{{ route('admin.guests.index') }}" variant="secondary" size="md">Batal</x-ui.btn>
            </div>
        </form>
    </x-ui.card>

</x-admin-layout>
