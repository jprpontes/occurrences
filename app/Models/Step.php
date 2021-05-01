<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $table = 'steps';

    protected $fillable = [
        'sector_id',
        'name',
        'next_step',
        'prev_step',
        'allowstart',
        'allowend',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
