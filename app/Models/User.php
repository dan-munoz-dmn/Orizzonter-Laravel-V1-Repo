<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * Listas blancas
     */
    protected array $allowIncluded = ['roles', 'profile', 'profile.personalization'];


    protected array $allowFilter = ['id', 'name', 'email', 'role_id'];
    protected array $allowSort = ['id', 'name', 'last_name', 'email', 'created_at'];

    /**
     * Relaciones
     */
    public function roles()
    {
        return $this->belongsTo(Role::class);
    }


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Scopes reutilizables
     */

    // Scope para incluir relaciones (eager loading)
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));
        $allowIncluded = collect($this->allowIncluded);

        $filtered = array_filter($relations, fn($rel) => $allowIncluded->contains($rel));

        if (!empty($filtered)) {
            $query->with($filtered);
        }
    }

    // Scope para filtrar
    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $field => $value) {
            if ($allowFilter->contains($field)) {
                $query->where($field, 'LIKE', '%' . $value . '%');
            }
        }
    }

    // Scope para ordenar
    public function scopeSort(Builder $query)
    {
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $field) {
            $direction = 'asc';

            if (substr($field, 0, 1) === '-') {
                $direction = 'desc';
                $field = substr($field, 1);
            }

            if ($allowSort->contains($field)) {
                $query->orderBy($field, $direction);
            }
        }
    }

    // Scope para obtener todos o paginar
    public function scopeGetOrPaginate(Builder $query)
    {
        $perPage = intval(request('perPage'));

        return $perPage > 0
            ? $query->paginate($perPage)
            : $query->get();
    }
}