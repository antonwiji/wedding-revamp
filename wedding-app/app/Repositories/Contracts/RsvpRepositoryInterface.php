<?php

namespace App\Repositories\Contracts;

use App\Models\Guest;
use App\Models\Rsvp;

interface RsvpRepositoryInterface
{
    public function create(array $data): Rsvp;
    public function findByGuest(Guest $guest): ?Rsvp;
}
