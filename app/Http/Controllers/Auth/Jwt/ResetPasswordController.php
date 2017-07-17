<?php

namespace FlexIT\Http\Controllers\Auth\Jwt;

use FlexIT\Http\Controllers\Controller;

use JWTAuth;
use FlexIT\Http\Models\User;
use FlexIT\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function reset(ResetPasswordRequest $request)
    {
        // Restablece la contraseña del usuario. Si tiene éxito,
        // actualizará la contraseña en un modelo de usuario real y lo mantendrá en el
        // base de datos. De lo contrario analizaremos el error y devolveremos la respuesta.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // Si la contraseña se ha restablecido correctamente, enviamos el token
        // para la autenticacion. Si hay un error, lanzamos la informacion del error.
         if($response !== Password::PASSWORD_RESET) {
            return response()->json(['ok' => false, 'error' => trans($response)], 500);
        }

        // obtenemos al usuario para crear un nuevo token.
        $user = User::where('email', '=', $request->get('email'))->first();

        return response()->json([
            'ok' => true,
            'status' => 200,
            'token' => JWTAuth::fromUser($user)
        ]);
    }

    // Selecoiona los campos de la solicutd
    private function credentials(ResetPasswordRequest $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    // Encripta y guarda nuevo password
    private function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password)
        ])->save();
    }

    // Metodo del cors de Laravel
    // para el manejo de reset de contraseña
    private function broker()
    {
        return Password::broker();
    }
}
