<?php

namespace App\Livewire\Guest;

use App\Models\Guest;
use App\Services\RsvpService;
use Livewire\Component;

class RsvpForm extends Component
{
    public Guest $guest;
    public string $status = 'attending';
    public int $actualAttendees = 1;
    public string $message = '';

    public function mount(Guest $guest): void
    {
        $this->guest = $guest;
        $this->actualAttendees = 1;
    }

    public function increaseAttendees(): void
    {
        if ($this->actualAttendees < $this->guest->max_attendees) {
            $this->actualAttendees++;
        }
    }

    public function decreaseAttendees(): void
    {
        if ($this->actualAttendees > 1) {
            $this->actualAttendees--;
        }
    }

    public function submit(RsvpService $rsvpService): void
    {
        $this->validate([
            'status'         => ['required', 'in:attending,not_attending'],
            'actualAttendees'=> ['required', 'integer', 'min:1', 'max:' . $this->guest->max_attendees],
            'message'        => ['nullable', 'string', 'max:500'],
        ]);

        $rsvpService->submit($this->guest, [
            'status'           => $this->status,
            'actual_attendees' => $this->actualAttendees,
            'message'          => $this->message ?: null,
        ]);

        session()->flash('success', 'RSVP kamu telah kami terima. Terima kasih!');
        $this->redirect(route('invitation.show', $this->guest->invitation_code));
    }

    public function render()
    {
        return view('livewire.guest.rsvp-form');
    }
}
