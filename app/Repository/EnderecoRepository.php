<?php

namespace App\Repository;

use App\Models\Endereco;
use App\Http\Client\ClienteViaCep;


class EnderecoRepository
{

    public function criaEnderecoCobranca($id, $cep): Endereco
    {
        $cliente = new ClienteViaCep();
        $dados = $cliente->buscaCep($cep);
        $endereco = new Endereco();
        $endereco->usuario_id = $id;
        $endereco->cep = $dados['cep'];
        $endereco->estado = $dados['uf'];
        $endereco->cidade = $dados['localidade'];
        $endereco->bairro = $dados['bairro'];
        $endereco->complemento = $dados['complemento'];
        $endereco->save();
        return $endereco;
    }
}
