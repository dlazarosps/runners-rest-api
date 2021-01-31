<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Runner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cpf', 'birthday'];

    protected $casts = [
        'birthday' => 'date:d/m/Y',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function contest(): HasMany
    {
        return $this->hasMany('App\Models\Contest');
    }
}
