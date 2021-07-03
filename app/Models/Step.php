<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $table = 'steps';

    protected $fillable = [
        'sector_id',
        'name',
        'next_step',
        'prev_step',
        'allowstart',
        'allowend',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_steps');
    }

    public function prevStep()
    {
        return $this->belongsTo(Step::class, 'prev_step');
    }

    public function nextStep()
    {
        return $this->belongsTo(Step::class, 'next_step');
    }
}
