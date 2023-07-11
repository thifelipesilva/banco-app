<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Client\ClienteViaCep;
use App\Http\Requests\LoginRequest;
use App\Repository\ContaRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioRequest;
use App\Repository\EnderecoRepository;
use App\Repository\UsuarioRepository;
use App\Service\AuthService;

class AuthController extends Controller
{
    private $usuarioRepositorio;
    private $contaRepositorio;
    private $enderecoRepositorio;
    private $authService;

    public function __construct(
        UsuarioRepository $usuarioRepositorio,
        ContaRepository $contaRepositorio,
        EnderecoRepository $enderecoRepositorio,
        AuthService $authService
    ) {
        $this->usuarioRepositorio = $usuarioRepositorio;
        $this->contaRepositorio = $contaRepositorio;
        $this->enderecoRepositorio = $enderecoRepositorio;
        $this->authService = $authService;
    }

    public function registrar(UsuarioRequest $req)
    {
        $dados = $req->validated();
        $usuario = $this->usuarioRepositorio->criaUsuario($dados);
        $conta = $this->contaRepositorio->criaConta($usuario->id);
        $endereco = $this->enderecoRepositorio->criaEnderecoCobranca($usuario->id, $dados['cep']);

        return response(compact('usuario', 'conta', 'endereco'), 201);
    }

    public function logar(LoginRequest $req)
    {
        $credenciais = $req->validated();

        $token = $this->authService->autenticaUsuario($credenciais);

        return response(["token" => $token], 200);
    }

    public function deslogar(Request $req)
    {
        $usuario = $req->usuario();
        $usuario->currenteAcessToken()->delete();
        return response('', 204);
    }
}
