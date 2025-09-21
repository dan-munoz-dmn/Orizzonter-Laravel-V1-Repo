<?php

namespace App\Services;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AnnouncementService
{
    public function getAll(): Collection|LengthAwarePaginator;

    public function store(array $data): Announcement;

    public function getByIdWithRelations(Announcement $announcement): Announcement;

    public function update(Announcement $announcement, array $data): Announcement;

    public function delete(Announcement $announcement): bool;
}
