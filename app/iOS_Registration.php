<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;

class iOS_Registration extends Model
{
    protected $table = 'ios_registrations';

    protected $fillable = [
    	'uuid', 'pass_type_id', 'push_token', 'ios_devices_id', 'ios_passes_serial'
    ];
}
