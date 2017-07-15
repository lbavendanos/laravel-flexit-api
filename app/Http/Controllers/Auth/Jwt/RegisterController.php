<?php

namespace FlexIT\Http\Controllers\Auth\Jwt;

use FlexIT\Http\Controllers\Controller;

use JWTAuth;
use FlexIT\Http\Models\User;
use FlexIT\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Crear Usuario
        $user = $this->create($request->all());
        // Crea token basado en el objeto user
        $token = JWTAuth::fromUser($user);

        // Envia respuesta con el token
        return response()->json([
            'ok' => true,
            'token' => $token
        ], 201);
    }

    private function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
