<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositoRequest;
use App\Http\Requests\TransferenciaRequest;
use App\Models\Conta;
use App\Models\Deposito;
use App\Models\Transferencia;

class TransacoesController extends Controller
{
    public function depositar(DepositoRequest $req, $id)
    {

        $dados = $req->validated();

        $conta = Conta::find($id);

        if (!$conta) {
            return response()->json([
                'mensagem' => 'Conta não encontrada',
                'conta' => $conta
            ], 404);
        }

        $saldo_total = $conta->saldo + $dados['valor'];

        $conta->saldo = $saldo_total;
        $conta->save();

        $authorizationCode = 'DEP' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $deposito = new Deposito();
        $deposito->conta_id = $conta->id;
        $deposito->valor = $saldo_total;
        $deposito->codigo_autorizacao = $authorizationCode;
        $deposito->save();

        return response(compact(['conta', 'deposito']), 200);
    }

    public function transferir(TransferenciaRequest $req, $id, $conta_destino)
    {
        $dados = $req->validated();

        $conta = Conta::find($id);


        $conta_destino_valor = Conta::find($conta_destino);

        if (!$conta || !$conta_destino_valor) {
            return response()->json([
                'mensagem' => 'Conta não encontrada',
                'conta' => $conta
            ], 404);
        }

        if ($conta->saldo < $dados['valor']) {
            return response()->json([
                'mensagem' => 'Saldo insuficiente',
                'Saldo' => $conta->saldo
            ], 401);
        }

        $saldo_total = $conta->saldo - $dados['valor'];
        $dinheiro_a_receber = $conta_destino_valor->saldo + $dados['valor'];

        $conta->saldo = $saldo_total;
        $conta_destino_valor->saldo = $dinheiro_a_receber;

        $conta->save();
        $conta_destino_valor->save();

        $authorizationCode = 'TRAN' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $transferencia = new Transferencia();
        $transferencia->conta_id = $conta->id;
        $transferencia->valor = $dados['valor'];
        $transferencia->conta_destino = $conta_destino_valor->id;
        $transferencia->codigo_autorizacao = $authorizationCode;
        $transferencia->save();


        return response(compact(['conta', 'transferencia']), 200);
    }
}
