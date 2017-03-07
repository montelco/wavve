<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    protected $guarded = 'id';
    protected $fillable = [
        'visitor_cookie_id', 'redemption_id', 'passes_uuid',
    ];

    public function pass()
    {
        return $this->belongsTo('Wavvve\Pass', 'passes_uuid');
    }
}
