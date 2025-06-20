<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request): mixed
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //Validamos solo estos campos
        $credentials = $request->only('email', 'password');
//        Valida que el usuario exista y la contraseña sea correcta
        if (auth()->attempt($credentials)) {
            //llamamos al usuario logueado
            $user = auth()->user();
            return response()->json([
                'token' => $user->createToken('API Token')->plainTextToken,
                'user' => $user,
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request): mixed
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        //Creamos el usuario
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            "¡"
        ]);

        //Generamos el token
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        //llamamos al usuario logueado
        $user = auth()->user();
        /*Eliminamos el token*/
        $user->tokens()->delete();
    }
}
