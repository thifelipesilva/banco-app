<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Transferencia;
use App\Http\Requests\DepositoRequest;
use App\Service\Operacoes\DepositoService;
use App\Http\Requests\TransferenciaRequest;
use App\Service\Operacoes\TransferenciaService;

class TransacoesController extends Controller
{
    private $depositoService;
    private $transferenciaService;

    public function __construct(DepositoService $deposito, TransferenciaService $transferenciaService)
    {
        $this->depositoService = $deposito;
        $this->transferenciaService = $transferenciaService;
    }

    public function depositar(DepositoRequest $req, $id)
    {
        $dados = $req->validated();
        $transacao = $this->depositoService->transacao($id, $dados);
        return response($transacao, 200);
    }

    public function transferir(TransferenciaRequest $req, $id, $conta_destino)
    {
        $dados = $req->validated();
        $transacao = $this->transferenciaService->transacao($id, $conta_destino, $dados);
        return response($transacao, 200);
    }
}
