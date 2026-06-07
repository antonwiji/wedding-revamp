<?php

namespace App\Services;

use App\Models\Guest;

class InvitationService
{
    public function findByCode(string $code): ?Guest
    {
        return Guest::where('invitation_code', $code)->first();
    }
}
