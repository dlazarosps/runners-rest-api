<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = ['race_id', 'runner_id', 'duration'];

    protected $hidden = ['created_at', 'updated_at'];
}
