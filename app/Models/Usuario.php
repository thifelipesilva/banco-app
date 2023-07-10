<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = ['nome', 'email', 'data_nascimento', 'cpf', 'password'];

    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class, 'usuario_id');
    }

    public function conta(): HasOne
    {
        return $this->hasOne(Conta::class, 'usuario_id');
    }
}
