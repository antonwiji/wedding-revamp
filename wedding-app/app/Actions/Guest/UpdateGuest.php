<?php

namespace App\Actions\Guest;

use App\Models\Guest;
use App\Services\GuestService;

class UpdateGuest
{
    public function __construct(private GuestService $guestService) {}

    public function handle(Guest $guest, array $data): Guest
    {
        return $this->guestService->update($guest, $data);
    }
}
