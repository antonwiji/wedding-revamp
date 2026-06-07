<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GuestService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private GuestService $guestService) {}

    public function index(): View
    {
        $statistics = $this->guestService->getStatistics();

        return view('admin.dashboard', compact('statistics'));
    }
}
