<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Maneja la solicitud de inicio de sesión y genera un token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 1. Validar las credenciales
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Intentar autenticar al usuario
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // 3. Obtener el usuario autenticado
        $user = $request->user();

        // 4. Generar el token de acceso
        // El nombre del token ('auth-token') es solo para identificación.
        $token = $user->createToken('auth-token')->plainTextToken;

        // 5. Devolver el token en la respuesta
        return response()->json([
            'status' => 'success',
            'message' => 'Login exitoso',
            'data' => [
                'token' => $token,
            ]
        ], 200);
    }

    /**
     * Maneja la solicitud de cierre de sesión y revoca el token actual.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // 1. Revocar el token actual del usuario
        $request->user()->currentAccessToken()->delete();

        // 2. Devolver una respuesta exitosa
        return response()->json([
            'status' => 'success',
            'message' => 'Logout exitoso',
            'data' => null
        ], 200);
    }
}
