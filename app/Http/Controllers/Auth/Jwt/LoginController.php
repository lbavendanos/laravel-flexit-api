<?php

namespace FlexIT\Http\Controllers\Auth\Jwt;

use FlexIT\Http\Controllers\Controller;

use JWTAuth;
use Carbon\Carbon;
use FlexIT\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // Captura las credenciales de la solicitud
        $credentials = $request->only(['email', 'password']);
        try {
            // Verfica las credenciales y crear un token para el usuario
            if (! $token = JWTAuth::attempt($credentials, $this->rememberLogin($request->has('remember'))) ) {
                return response()->json(['ok' => false, 'error' => 'Credenciales invalidas'], 401);
            }
        } catch (JWTException $e) {
            // Captura error al intentar codificar el token
            return response()->json(['ok' => false, 'error' => 'No se pudo crear un token'], 500);
        }

        return response()
            ->json([
                'ok' => true,
                'token' => $token
            ]);
    }

    private function rememberLogin($remember)
    {
        if($remember){
            $expiration = Carbon::now('UTC')->addWeeks(2)->getTimestamp();
            return ['exp' => $expiration];
        }

        return [];
    }
}
