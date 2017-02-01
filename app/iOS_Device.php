<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;

class iOS_Device extends Model
{
    protected $table = 'ios_devices';

    protected $fillable = [
        'device', 'push_token',
    ];
}
