<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'occurrence_id',
        'activity_id',
        'user_id',
        'anotation',
        'updated_by'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userWhoChanged()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
