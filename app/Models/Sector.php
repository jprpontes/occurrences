<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'sectors';

    protected $fillable = [
        'name',
        'document_type',
        'document_table',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
