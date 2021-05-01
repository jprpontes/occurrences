<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workorder extends Model
{
    protected $table = 'workorders';

    protected $fillable = [
        'open_description',
        'worktype_id',
        'executed_work',
        'warranty',
        'operator_id',
        'technical_id',
        'faultresponsibility_id',
        'contacttype_id',
        'defect_id',
        'priority',
        'emission',
        'avati_id',
        'completed',
        'due_date',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
