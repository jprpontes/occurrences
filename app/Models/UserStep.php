<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStep extends Model
{
    protected $table = 'user_steps';

    protected $fillable = [
        'user_id',
        'step_id',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
