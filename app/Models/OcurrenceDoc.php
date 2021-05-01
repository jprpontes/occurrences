<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OcurrenceDoc extends Model
{
    protected $table = 'ocurrence_docs';

    protected $fillable = [
        'occurrence_id',
        'sales_id',
        'invoices_id',
        'workorders_id',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
