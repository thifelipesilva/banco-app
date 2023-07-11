<?php

namespace App\Service;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function autenticaUsuario($dados)
    {
        $usuario = Usuario::where('email', $dados['email'])->first();

        if (!$usuario || !Hash::check($dados['password'], $usuario->password)) {
            return response([
                'mensagem' => 'Email ou senha incorreto'
            ], 401);
        }

        $usuario->tokens()->delete();

        $token = $usuario->createToken('token-name')->plainTextToken;

        return (["token" => $token]);
    }
}
