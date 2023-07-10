<?php

namespace App\Repository;

use App\Models\Transferencia;

class TransferenciaRepository
{
    public function criaTransferencia($id, $idContaReceber, $codigoAutorizacao, $valorTransferencia): Transferencia
    {
        $transferencia = new Transferencia();
        $transferencia->conta_id = $id;
        $transferencia->valor = $valorTransferencia;
        $transferencia->conta_destino = $idContaReceber;
        $transferencia->codigo_autorizacao = $codigoAutorizacao;
        $transferencia->save();
        return $transferencia;
    }
}
