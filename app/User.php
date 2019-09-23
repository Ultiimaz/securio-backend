<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    protected $fillable = [
        'name', 'email', 'master_password',
    ];

    protected $hidden = [
       'id',
        'master_password',
        'remember_token',
        'provider',
        'provider_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'administrations'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function administrations()
    {
        return $this->hasMany(AdministrationRelation::class);
    }

}
