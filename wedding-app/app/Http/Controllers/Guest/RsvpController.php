<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StoreRsvpRequest;
use App\Services\InvitationService;
use App\Services\RsvpService;
use Illuminate\Http\RedirectResponse;

class RsvpController extends Controller
{
    public function __construct(
        private InvitationService $invitationService,
        private RsvpService $rsvpService,
    ) {}

    public function store(StoreRsvpRequest $request, string $code): RedirectResponse
    {
        $guest = $this->invitationService->findByCode($code);

        if (! $guest) {
            abort(404, 'Undangan tidak ditemukan.');
        }

        $this->rsvpService->submit($guest, $request->validated());

        return redirect()->route('invitation.show', $code)
            ->with('success', 'RSVP kamu telah kami terima. Terima kasih!');
    }
}
