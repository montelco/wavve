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

    public function passes()
    {
    	return $this->belongsTo('Wavvve\Pass', 'visitors_passes_uuid_index');
    }
}
