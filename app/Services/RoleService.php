<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RoleService
{
    public function getAll(): Collection|LengthAwarePaginator;

    public function store(array $data): Role;

    public function getByIdWithRelations(Role $role): Role;

    public function update(Role $role, array $data): Role;

    public function delete(Role $role): bool;
}
