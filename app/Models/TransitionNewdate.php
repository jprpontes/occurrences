<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransitionNewdate extends Model
{
    protected $table = 'transition_newdate';

    protected $fillable = [
        'transitions_id',
        'new_doc_date',
        'observation',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
