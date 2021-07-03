<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{
    protected $table = 'occurrences';

    protected $fillable = [
        'title',
        'person_id',
        'contract_id'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function transitions()
    {
        return $this->hasMany(Transition::class);
    }
}
