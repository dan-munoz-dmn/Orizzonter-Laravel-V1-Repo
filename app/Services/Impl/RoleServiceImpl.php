<?php

namespace App\Services\Impl;

use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoleServiceImpl implements RoleService
{
    /**
     * Obtener todos los roles con scopes aplicados
     */
    public function getAll(): Collection|LengthAwarePaginator
    {
        return Role::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }

    /**
     * Crear un nuevo rol
     */
    public function store(array $data): Role
    {
        return Role::create($data);
    }

    /**
     * Obtener un rol específico con relaciones dinámicas
     */
    public function getByIdWithRelations(Role $role): Role
    {
        return $role->load(request('included') ? explode(',', request('included')) : []);
    }

    /**
     * Actualizar un rol
     */
    public function update(Role $role, array $data): Role
    {
        $role->update($data);
        return $role;
    }

    /**
     * Eliminar un rol
     */
    public function delete(Role $role): bool
    {
        return $role->delete();
    }
}
