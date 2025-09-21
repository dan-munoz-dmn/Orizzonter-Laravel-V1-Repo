<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Services\UserService;

class UserServiceImpl implements UserService
{
    public function getAll()
    {
        return User::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }

    public function store(array $data): User
    {
        return User::create($data);
    }

    //se cargan relaciones
    public function getByIdWithRelations(User $user): User
    {
        return $user->load(request('included') ? explode(',', request('included')) : []);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
