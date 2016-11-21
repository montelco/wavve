<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';
    protected $guarded = 'id';
    protected $fillable = [
        'passes_uuid', 'visitor_cookie',
    ];
    protected $appends = [
        'FriendlyTime',
    ];

    public function getFriendlyTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function passes()
    {
        return $this->belongsTo('Wavvve\Pass', 'passes_uuid', 'uuid');
    }
}
