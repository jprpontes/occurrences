<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';

    protected $fillable = [
        'integration_id',
        'name',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
