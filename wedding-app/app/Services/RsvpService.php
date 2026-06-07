<?php

namespace App\Services;

use App\Models\Guest;
use App\Models\Rsvp;
use Illuminate\Support\Facades\DB;

class RsvpService
{
    public function submit(Guest $guest, array $data): Rsvp
    {
        return DB::transaction(function () use ($guest, $data) {
            $rsvp = Rsvp::create([
                'guest_id'         => $guest->id,
                'status'           => $data['status'],
                'actual_attendees' => $data['actual_attendees'] ?? 1,
                'message'          => $data['message'] ?? null,
                'submitted_at'     => now(),
                'ip_address'       => request()->ip(),
            ]);

            $guest->update([
                'rsvp_status'  => $data['status'],
                'confirmed_at' => now(),
            ]);

            return $rsvp;
        });
    }
}
