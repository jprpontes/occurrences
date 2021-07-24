<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    const PASSWORD_MIN_SIZE = 8;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'updated_by'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allRoles()
    {
        return $this->roles()->pluck('name');
    }

    public function dataToClient()
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email
        ];
    }
}
