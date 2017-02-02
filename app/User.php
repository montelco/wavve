<?php

namespace Wavvve;

use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    protected $fillable = [
        'name', 'email', 'password', 'profile_pic', 'apple_auth', 'last_logged_in',
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
            'Wavvve\Visitor',
            'Wavvve\Pass',
            'uuid',
            'passes_uuid',
            'id'
        );
    }
}
