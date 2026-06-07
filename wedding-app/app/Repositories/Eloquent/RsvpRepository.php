<?php

namespace App\Repositories\Eloquent;

use App\Models\Guest;
use App\Models\Rsvp;
use App\Repositories\Contracts\RsvpRepositoryInterface;

class RsvpRepository implements RsvpRepositoryInterface
{
    public function create(array $data): Rsvp
    {
        return Rsvp::create($data);
    }

    public function findByGuest(Guest $guest): ?Rsvp
    {
        return Rsvp::where('guest_id', $guest->id)->latest()->first();
    }
}
