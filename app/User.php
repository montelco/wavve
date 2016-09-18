<?php

namespace Wavvve;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasRoles;
    use Billable;

    protected $fillable = [
        'name', 'email', 'password', 'profile_pic',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function passes()
    {
        return $this->hasMany('Wavvve\Pass');
    }
}
