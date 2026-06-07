<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Services\GuestService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private GuestService $guestService) {}

    public function index(): View
    {
        $stats         = $this->guestService->getStatistics();
        $recentGuests  = Guest::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentGuests'));
    }
}
