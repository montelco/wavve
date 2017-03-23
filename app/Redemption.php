<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    protected $table = 'redemptions';
    protected $guarded = 'id';
    protected $fillable = [
        'visitor_cookie_id', 'redemption_id', 'passes_uuid',
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
        return $this->belongsTo('Wavvve\Pass', 'passes_uuid');
    }
}
