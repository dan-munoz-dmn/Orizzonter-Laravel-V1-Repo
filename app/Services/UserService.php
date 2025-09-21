<?php

namespace App\Services;

use App\Models\User;

interface UserService
{
    public function getAll();

    public function store(array $data): User;

    public function getByIdWithRelations(User $user): User;

    public function update(User $user, array $data): User;

    public function delete(User $user): bool;
}
