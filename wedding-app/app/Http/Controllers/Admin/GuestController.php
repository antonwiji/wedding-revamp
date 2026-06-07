<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGuestRequest;
use App\Http\Requests\Admin\UpdateGuestRequest;
use App\Models\Guest;
use App\Services\GuestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function __construct(private GuestService $guestService) {}

    public function index(): View
    {
        $guests = Guest::latest()->paginate(15);

        return view('admin.guests.index', compact('guests'));
    }

    public function create(): View
    {
        return view('admin.guests.create');
    }

    public function store(StoreGuestRequest $request): RedirectResponse
    {
        $this->guestService->create($request->validated());

        return redirect()->route('admin.guests.index')
            ->with('success', 'Tamu berhasil ditambahkan.');
    }

    public function edit(Guest $guest): View
    {
        return view('admin.guests.edit', compact('guest'));
    }

    public function update(UpdateGuestRequest $request, Guest $guest): RedirectResponse
    {
        $this->guestService->update($guest, $request->validated());

        return redirect()->route('admin.guests.index')
            ->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function destroy(Guest $guest): RedirectResponse
    {
        $this->guestService->delete($guest);

        return redirect()->route('admin.guests.index')
            ->with('success', 'Tamu berhasil dihapus.');
    }

    public function export()
    {
        // Excel export — akan diimplementasi di fitur berikutnya
        abort(501, 'Export belum diimplementasi.');
    }
}
