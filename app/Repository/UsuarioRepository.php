<?php

namespace App\Repository;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioRepository
{

    public function criaUsuario($dados): Usuario
    {
        return Usuario::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'data_nascimento' => $dados['data_nascimento'],
            'cpf' => $dados['cpf'],
            'password' => Hash::make($dados['password']),
        ]);
    }

    public function procuraUsuario($id): Usuario
    {
        return Usuario::findo($id);
    }
}
