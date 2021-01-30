<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    const RACE_TYPES = ['3km', '5km', '10km', '21km', '42km'];

    protected $fillable = ['type', 'race_date'];

    protected $casts = [
        'race_date' => 'date:d/m/Y',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
