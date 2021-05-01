<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';

    protected $fillable = [
        'integration_id',
        'fadmin_id',
        'person_id',
        'name',
        'state_id'
    ];

    protected $hidden = [
        'updated_at'
    ];
}
