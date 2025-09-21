<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProfileService
{
    public function getAll(): Collection|LengthAwarePaginator;

    public function store(array $data): Profile;

    public function getByIdWithRelations(Profile $profile): Profile;

    public function update(Profile $profile, array $data): Profile;

    public function delete(Profile $profile): bool;
}
