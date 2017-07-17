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
        return response()->json([
            'ok' => true,
            'status' => 200
        ], 200);
    }

    private function broker()
    {
        return Password::broker();
    }
}
