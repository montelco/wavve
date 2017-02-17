<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Beacon extends Model
{
    protected $fillable = [
        'user_id', 'uuid', 'hardware_address', 'lon', 'lat', 'nickname', 'software', 'hardware',
    ];

    public function user()
    {
        return $this->belongsTo('Wavvve\User', 'user_id');
    }
}
