<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'integration_id',
        'contact_attendant_name',
        'email',
        'email2',
        'phone',
        'phone2',
        'person_id',
    ];

    protected $hidden = [
        'updated_at'
    ];
}
