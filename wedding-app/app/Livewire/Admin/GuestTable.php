<?php

namespace App\Livewire\Admin;

use App\Models\Guest;
use Livewire\Component;
use Livewire\WithPagination;

class GuestTable extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterStatus = '';
    public string $filterCategory = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $guests = Guest::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('invitation_code', 'like', "%{$this->search}%"))
            ->when($this->filterStatus, fn ($q) => $q->where('rsvp_status', $this->filterStatus))
            ->when($this->filterCategory, fn ($q) => $q->where('category', $this->filterCategory))
            ->latest()
            ->paginate(15);

        return view('livewire.admin.guest-table', compact('guests'));
    }
}
