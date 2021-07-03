<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OccurrenceDoc extends Model
{
    protected $table = 'occurrence_docs';

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
