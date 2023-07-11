<?php

namespace App\Service\Operacoes;

use App\Repository\ContaRepository;
use App\Repository\TransferenciaRepository;

class TransferenciaService implements CodigoAutorizacao
{
    private $contaRepositorio;
    private $transRepositorio;

    public function __construct(ContaRepository $contaRepositorio, TransferenciaRepository $transRepositorio)
    {
        $this->contaRepositorio = $contaRepositorio;
        $this->transRepositorio = $transRepositorio;
    }

    public function transacao($id, $idContaReceber, $dados)
    {
        $conta = $this->contaRepositorio->procuraConta($id);
        $conta_destino_valor = $this->contaRepositorio->procuraConta($idContaReceber);

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

        //conta enviando dinheiro
        $saldo_total_conta = $conta->saldo - $dados['valor'];
        $conta->saldo = $saldo_total_conta;
        $conta->save();

        //conta recebendo
        $dinheiro_a_receber = $conta_destino_valor->saldo + $dados['valor'];
        $conta_destino_valor->saldo = $dinheiro_a_receber;
        $conta_destino_valor->save();

        $codigoAutorizacao = $this->criaCodigoAutorizacao();

        $transacao = $this->transRepositorio->criaTransferencia($id, $idContaReceber, $codigoAutorizacao, $dados['valor']);

        return ([$conta, $transacao]);
    }

    public function criaCodigoAutorizacao(): string
    {
        return 'TRANSF' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }
}
