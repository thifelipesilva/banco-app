<?php

namespace App\Repository;

use App\Models\Conta;

class ContaRepository
{
    public function criaConta($id): Conta
    {
        $conta = new Conta();
        $conta->usuario_id = $id;
        $conta->saldo = 0;
        $conta->save();

        return $conta;
    }

    public function procuraConta($id): Conta
    {
        return Conta::find($id);
    }
}
