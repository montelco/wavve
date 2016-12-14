<?php

namespace Wavvve;

use Laravel\Cashier\Billable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function visitors()
    {
        return $this->hasManyThrough(
            'Wavvve\Visitor', 'Wavvve\Pass',
            'uuid', 'passes_uuid', 'id'
        );
    }
}
