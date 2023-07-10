<?php

namespace App\Repository;

use App\Models\Deposito;

class DepositoRepository
{
    public function criaDeposito($id, $codigoAutorizacao, $valorDepositado): Deposito
    {
        $deposito = new Deposito();
        $deposito->conta_id = $id;
        $deposito->valor = $valorDepositado;
        $deposito->codigo_autorizacao = $codigoAutorizacao;
        $deposito->save();
        return $deposito;
    }
}
