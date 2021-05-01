<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'sector_id',
        'name',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
