<?php

namespace App\Service\Operacoes;

use App\Repository\ContaRepository;
use App\Repository\DepositoRepository;

class DepositoService implements CodigoAutorizacao
{
    private $contaRepositorio;
    private $depRepositorio;

    public function __construct(ContaRepository $contaRepositorio, DepositoRepository $depRepositorio)
    {
        $this->contaRepositorio = $contaRepositorio;
        $this->depRepositorio = $depRepositorio;
    }

    public function transacao($id, $dados)
    {
        $conta = $this->contaRepositorio->procuraConta($id);

        if (!$conta) {
            return response()->json([
                'mensagem' => 'Conta não encontrada',
                'conta' => $conta
            ], 404);
        }

        $saldo_total = $conta->saldo + $dados['valor'];

        $conta->saldo = $saldo_total;
        $conta->save();
        $codigoAutorizacao = $this->criaCodigoAutorizacao();

        $deposito = $this->depRepositorio->criaDeposito($conta->id, $codigoAutorizacao, $dados['valor']);

        return ([$conta, $deposito]);
    }

    public function criaCodigoAutorizacao(): string
    {
        return 'DEP' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }
}
