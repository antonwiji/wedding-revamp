<?php

namespace App\Repositories\Eloquent;

use App\Models\Guest;
use App\Repositories\Contracts\GuestRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GuestRepository implements GuestRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Guest::latest()->paginate($perPage);
    }

    public function findByCode(string $code): ?Guest
    {
        return Guest::where('invitation_code', $code)->first();
    }

    public function create(array $data): Guest
    {
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
}
