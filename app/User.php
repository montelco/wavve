<?php

namespace Wavvve;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

	use HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'profile_pic'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function passes(){
        return $this->hasMany('Wavvve\Pass');
    }
    
}
