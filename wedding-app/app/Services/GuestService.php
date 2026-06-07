<?php

namespace App\Services;

use App\Enums\GuestCategory;
use App\Models\Guest;
use Illuminate\Support\Str;

class GuestService
{
    public function create(array $data): Guest
    {
        $data['invitation_code'] = $this->generateCode();

        return Guest::create($data);
    }

    public function update(Guest $guest, array $data): Guest
    {
        $guest->update($data);

        return $guest->fresh();
    }

    public function delete(Guest $guest): bool
    {
        return $guest->delete();
    }

    public function getStatistics(): array
    {
        return [
            'total'         => Guest::count(),
            'attending'     => Guest::attending()->count(),
            'not_attending' => Guest::where('rsvp_status', 'not_attending')->count(),
            'pending'       => Guest::where('rsvp_status', 'pending')->count(),
            'vip'           => Guest::byCategory(GuestCategory::VIP)->count(),
        ];
    }

    private function generateCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Guest::where('invitation_code', $code)->exists());

        return $code;
    }
}
