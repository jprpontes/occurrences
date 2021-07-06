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
        'updated_by'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    public function occurrence()
    {
        return $this->belongsTo(Occurrence::class);
    }

    public function userWhoChanged()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
