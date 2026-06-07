<div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 text-center">
        <p class="text-3xl font-bold text-gray-800">{{ $statistics['total'] ?? 0 }}</p>
        <p class="text-gray-500 text-sm mt-1">Total Tamu</p>
    </div>
    <div class="bg-green-50 rounded-xl border border-green-100 shadow-sm p-5 text-center">
        <p class="text-3xl font-bold text-green-700">{{ $statistics['attending'] ?? 0 }}</p>
        <p class="text-green-600 text-sm mt-1">Hadir</p>
    </div>
    <div class="bg-red-50 rounded-xl border border-red-100 shadow-sm p-5 text-center">
        <p class="text-3xl font-bold text-red-700">{{ $statistics['not_attending'] ?? 0 }}</p>
        <p class="text-red-600 text-sm mt-1">Tidak Hadir</p>
    </div>
    <div class="bg-yellow-50 rounded-xl border border-yellow-100 shadow-sm p-5 text-center">
        <p class="text-3xl font-bold text-yellow-700">{{ $statistics['pending'] ?? 0 }}</p>
        <p class="text-yellow-600 text-sm mt-1">Menunggu</p>
    </div>
    <div class="bg-purple-50 rounded-xl border border-purple-100 shadow-sm p-5 text-center">
        <p class="text-3xl font-bold text-purple-700">{{ $statistics['vip'] ?? 0 }}</p>
        <p class="text-purple-600 text-sm mt-1">VIP</p>
    </div>
</div>
