<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\StoreProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\Profile;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Listar perfiles
     */
    public function index(): JsonResponse
    {
        $profiles = $this->profileService->getAll();

        return response()->json([
            'status' => 'success',
            'data' => $profiles,
        ]);
    }

    /**
     * Crear perfil para el usuario autenticado
     */
    public function store(StoreProfileRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();

        $profile = $this->profileService->store($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Perfil creado correctamente.',
            'data' => $profile,
        ], 201);
    }

    /**
     * Mostrar un perfil con relaciones dinámicas
     */
    public function show(Profile $profile): JsonResponse
    {
        $data = $this->profileService->getByIdWithRelations($profile);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Actualizar perfil (solo el dueño puede hacerlo)
     */
    public function update(UpdateProfileRequest $request, Profile $profile): JsonResponse
    {
        if (Auth::id() !== $profile->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tienes permiso para editar este perfil.',
            ], 403);
        }

        $validatedData = $request->validated();
        $updated = $this->profileService->update($profile, $validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Perfil actualizado correctamente.',
            'data' => $updated->fresh(),
        ]);
    }

    /**
     * Eliminar perfil (solo el dueño puede hacerlo)
     */
    public function destroy(Profile $profile): JsonResponse
    {
        if (Auth::id() !== $profile->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tienes permiso para eliminar este perfil.',
            ], 403);
        }

        $this->profileService->delete($profile);

        return response()->json([
            'status' => 'success',
            'message' => 'Perfil eliminado correctamente.',
        ]);
    }
}
