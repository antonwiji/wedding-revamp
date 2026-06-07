<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\InvitationService;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InvitationController extends Controller
{
    public function __construct(private InvitationService $invitationService) {}

    public function show(string $code): View
    {
        $guest = $this->invitationService->findByCode($code);

        if (! $guest) {
            abort(404, 'Undangan tidak ditemukan.');
        }

        return view('pages.invitation', compact('guest'));
    }
}
