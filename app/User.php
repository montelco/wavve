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
        'name', 'email', 'password', 'profile_pic', 'apple_auth', 'last_logged_in', 'active',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function byEmail($email)
    {
        return static::where('email', $email);
    }

    public function beacons()
    {
        return $this->hasMany('Wavvve\Beacon');
    }

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

    public function activationToken()
    {
        return $this->hasOne(ActivationToken::class);
    }
}
