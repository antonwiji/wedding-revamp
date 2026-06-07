<?php

namespace App\Repositories\Contracts;

use App\Models\Guest;
use Illuminate\Pagination\LengthAwarePaginator;

interface GuestRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function findByCode(string $code): ?Guest;
    public function create(array $data): Guest;
    public function update(Guest $guest, array $data): Guest;
    public function delete(Guest $guest): bool;
}
