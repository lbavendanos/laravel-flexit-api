<?php

namespace FlexIT\Http\Controllers\Auth\Jwt;

use FlexIT\Http\Controllers\Controller;

use FlexIT\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetEmail(ForgotPasswordRequest $request)
    {
        // Envua el enlace de restablecimiento de contraseña a este usuario. Una vez que hemos intentado
        // para enviar el enlace, examinaremos la respuesta y veremos el mensaje que
        // necesidad de mostrar al usuario. Finalmente, enviaremos una respuesta adecuada.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        // Verifica respuesta
        if($response !== Password::RESET_LINK_SENT) {
            return response()->json(['ok' => false, 'error' => trans($response)], 500);
        }

        // Respuesta API
        return response()->json([
            'ok' => true,
            'status' => 200
        ], 200);
    }

    // Metodo del cors de Laravel
    // para el manejo de reset de contraseña
    private function broker()
    {
        return Password::broker();
    }
}
