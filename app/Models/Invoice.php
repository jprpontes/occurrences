<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'integration_id',
        'amount',
        'due_date',
        'state',
        'completed',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
