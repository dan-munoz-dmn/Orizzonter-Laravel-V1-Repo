<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Listar roles
     */
    public function index(): JsonResponse
    {
        $roles = $this->roleService->getAll();

        return response()->json([
            'status' => 'success',
            'data' => $roles,
        ]);
    }

    /**
     * Crear rol
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        $role = $this->roleService->store($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Rol creado correctamente.',
            'data' => $role,
        ], 201);
    }

    /**
     * Mostrar un rol
     */
    public function show(Role $role): JsonResponse
    {
        $data = $this->roleService->getByIdWithRelations($role);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Actualizar rol
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $updated = $this->roleService->update($role, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Rol actualizado correctamente.',
            'data' => $updated->fresh(),
        ]);
    }

    /**
     * Eliminar rol
     */
    public function destroy(Role $role): JsonResponse
    {
        $this->roleService->delete($role);

        return response()->json([
            'status' => 'success',
            'message' => 'Rol eliminado correctamente.',
        ]);
    }
}
