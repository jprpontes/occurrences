<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    const DOCUMENT_TYPE_INVOICE = 1;
    const DOCUMENT_TYPE_WORKORDER = 2;
    const DOCUMENT_TYPE_SALE = 3;

    const DOCUMENT_TYPE_LIST = [
        [
            'id'   => self::DOCUMENT_TYPE_INVOICE,
            'name' => 'Invoice'
        ],
        [
            'id'   => self::DOCUMENT_TYPE_WORKORDER,
            'name' => 'Workorder'
        ],
        [
            'id'   => self::DOCUMENT_TYPE_SALE,
            'name' => 'Sale'
        ],
    ];

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
