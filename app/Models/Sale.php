<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'plan',
        'ammount',
        'state',
        'completed',
        'due_date',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
