<?php

namespace App\Actions\Guest;

use App\Models\Guest;
use App\Services\GuestService;

class CreateGuest
{
    public function __construct(private GuestService $guestService) {}

    public function handle(array $data): Guest
    {
        return $this->guestService->create($data);
    }
}
