<x-layouts.guest>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center">
            <h1 class="text-5xl font-serif text-stone-700 mb-4">Wedding Invitation</h1>
            <p class="text-stone-500 text-lg">Masukkan kode undangan untuk melihat detail pernikahan kami.</p>

            <form method="GET" action="#" class="mt-8 flex gap-3 justify-center">
                <input
                    type="text"
                    name="code"
                    placeholder="Kode undangan..."
                    class="border border-stone-300 rounded-lg px-4 py-2 text-center tracking-widest uppercase focus:outline-none focus:ring-2 focus:ring-stone-400"
                    maxlength="8"
                />
                <button
                    type="submit"
                    class="bg-stone-700 text-white px-6 py-2 rounded-lg hover:bg-stone-800 transition"
                >
                    Buka Undangan
                </button>
            </form>
        </div>
    </div>
</x-layouts.guest>
