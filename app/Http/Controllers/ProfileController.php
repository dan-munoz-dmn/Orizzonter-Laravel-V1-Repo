<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\StoreProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index(): JsonResponse
    {
        $profiles = $this->profileService->getAll();

        return response()->json([
            'status' => 'success',
            'data' => $profiles
        ]);
    }

public function store(StoreProfileRequest $request): JsonResponse
    {
        // 1. Obtén los datos validados del request
        $validatedData = $request->validated();
        
        // 2. Asocia el perfil al usuario autenticado
        $validatedData['user_id'] = Auth::user()->id; // <-- Asocia al usuario logueado

        // 3. Crea el perfil
        $profile = Profile::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Perfil creado correctamente.',
            'data' => $profile,
        ], 201);
    }

    public function show(Profile $profile): JsonResponse
    {
        $data = $this->profileService->getByIdWithRelations($profile);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function update(UpdateProfileRequest $request, Profile $profile): JsonResponse
    {
        // 1. Asegúrate de que solo el dueño del perfil lo pueda actualizar
        if (Auth::user()->id !== $profile->user_id) {
            return response()->json(['error' => 'No tienes perm iso para editar este perfil.'], 403);
        }

        // 2. Valida los datos entrantes del formulario
        $validatedData = $request->validated();

        // 3. Actualiza el perfil
        $profile->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Perfil actualizado correctamente.',
            'data' => $profile->fresh(),
        ]);
    }

    public function destroy(Profile $profile): JsonResponse
    {
        $this->profileService->delete($profile);

        return response()->json([
            'status' => 'success',
            'message' => 'Perfil eliminado correctamente.',
        ]);
    }
}
