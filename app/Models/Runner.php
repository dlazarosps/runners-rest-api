<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Runner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cpf', 'birthday'];

    protected $casts = [
        'birthday' => 'date:d/m/Y',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
