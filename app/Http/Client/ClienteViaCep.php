<?php

namespace App\Http\Client;

use GuzzleHttp\Client;

class ClienteViaCep
{
    public function buscaCep($cep)
    {
        $url = "http://viacep.com.br/ws/{$cep}/json/";
        $client = new Client();
        $res = $client->get($url);
        $dados = json_decode($res->getBody(), true);
        return $dados;
    }
}
