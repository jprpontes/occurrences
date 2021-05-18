<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    protected $table = 'transitions';

    protected $fillable = [
        'occurrence_id',
        'step_id',
        'isactive',
        'wasapproved',
        'user_id',
        'close_date',
        'doc_due_date',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
