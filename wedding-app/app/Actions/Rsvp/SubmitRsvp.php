<?php

namespace App\Actions\Rsvp;

use App\Models\Guest;
use App\Models\Rsvp;
use App\Services\RsvpService;

class SubmitRsvp
{
    public function __construct(private RsvpService $rsvpService) {}

    public function handle(Guest $guest, array $data): Rsvp
    {
        return $this->rsvpService->submit($guest, $data);
    }
}
