<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Beacon extends Model
{
    protected $fillable = [
        'user_id', 'uuid', 'hardware_address', 'lon', 'lat', 'nickname', 'software', 'hardware',
    ];

    protected $appends = [
        'TerminalUuid',
    ];

    public function user()
    {
        return $this->belongsTo('Wavvve\User', 'user_id');
    }

    public function getTerminalUuidAttribute()
    {
        return strtoupper(rtrim(chunk_split(str_replace('-','',$this->uuid),2,' '),' '));
    }
}
