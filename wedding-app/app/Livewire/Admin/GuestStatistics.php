<?php

namespace App\Livewire\Admin;

use App\Services\GuestService;
use Livewire\Component;

class GuestStatistics extends Component
{
    public array $statistics = [];

    public function mount(GuestService $guestService): void
    {
        $this->statistics = $guestService->getStatistics();
    }

    public function render()
    {
        return view('livewire.admin.guest-statistics');
    }
}
