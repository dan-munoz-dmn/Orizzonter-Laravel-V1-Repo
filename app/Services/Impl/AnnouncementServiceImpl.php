<?php

namespace App\Services\Impl;

use App\Models\Announcement;
use App\Services\AnnouncementService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AnnouncementServiceImpl implements AnnouncementService
{
    /**
     * Obtener todos los anuncios con scopes aplicados
     */
    public function getAll(): Collection|LengthAwarePaginator
    {
        return Announcement::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }

    /**
     * Crear un anuncio
     */
    public function store(array $data): Announcement
    {
        return Announcement::create($data);
    }

    /**
     * Obtener un anuncio específico con relaciones dinámicas
     */
    public function getByIdWithRelations(Announcement $announcement): Announcement
    {
        return $announcement->load(request('included') ? explode(',', request('included')) : []);
    }

    /**
     * Actualizar un anuncio
     */
    public function update(Announcement $announcement, array $data): Announcement
    {
        $announcement->update($data);
        return $announcement;
    }

    /**
     * Eliminar un anuncio
     */
    public function delete(Announcement $announcement): bool
    {
        return $announcement->delete();
    }
}
