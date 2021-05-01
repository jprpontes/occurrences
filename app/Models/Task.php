<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'occurrence_id',
        'activity_id',
        'user_id',
        'anotation',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
