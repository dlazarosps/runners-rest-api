<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = ['race_id', 'runner_id', 'age', 'started_at', 'ended_at', 'duration'];

    protected $hidden = ['created_at', 'updated_at'];

    public function race(): BelongsTo
    {
        return $this->belongsTo('App\Models\Race');
    }

    public function runner(): BelongsTo
    {
        return $this->belongsTo('App\Models\Runner');
    }
}
