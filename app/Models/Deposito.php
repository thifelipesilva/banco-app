<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deposito extends Model
{
    use HasFactory;

    public function conta(): BelongsTo
    {
        return $this->belongsTo(Conta::class);
    }
}
