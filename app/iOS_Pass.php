<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;

class iOS_Pass extends Model
{
    protected $table = 'ios_passes';

    protected $fillable = [
    'passTypeID', 'authentication_token', 'serial_no'
    ];
}
