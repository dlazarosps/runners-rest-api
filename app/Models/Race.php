<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    use HasFactory;

    const RACE_TYPES = ['3km', '5km', '10km', '21km', '42km'];
    const AGE_RANGE = ['18-25', '25-35', '35-45', '45-55', '55-100'];

    protected $fillable = ['type', 'race_date'];

    protected $casts = [
        'race_date' => 'date:d/m/Y',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function contest(): HasMany
    {
        return $this->hasMany('App\Models\Contest');
    }
}
