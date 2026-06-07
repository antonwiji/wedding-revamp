<x-layouts.guest>
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-2xl mx-auto text-center">
            <p class="text-stone-500 uppercase tracking-widest text-sm mb-2">Undangan Pernikahan</p>
            <h1 class="text-4xl font-serif text-stone-700 mb-1">Budi & Ani</h1>
            <p class="text-stone-400 mb-8">Sabtu, 17 Agustus 2026</p>

            <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8 mb-8 text-left">
                <p class="text-stone-600">Kepada Yth.</p>
                <p class="text-xl font-semibold text-stone-800 mt-1">{{ $guest->name }}</p>
                @if ($guest->max_attendees > 1)
                    <p class="text-stone-500 text-sm mt-1">beserta {{ $guest->max_attendees - 1 }} orang</p>
                @endif
            </div>

            @if ($guest->rsvp_status->value !== 'pending')
                <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-8">
                    <p class="text-green-700 font-medium">RSVP Anda sudah kami terima</p>
                    <p class="text-green-600 text-sm mt-1">Status: {{ $guest->rsvp_status->label() }}</p>
                </div>
            @else
                <livewire:guest.rsvp-form :guest="$guest" />
            @endif
        </div>
    </div>
</x-layouts.guest>
