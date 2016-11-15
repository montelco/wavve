<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    protected $table = 'passes';
    protected $guarded = 'id';
    protected $fillable = [
        'header_foreground_image', 'header_background_image', 'title', 'expiry', 'strip_background_image', 'primary_field', 'secondary_field', 'coupon_full_background_image', 'barcode_value', 'cashier_helper', 'uuid', 'template_number', 'theme', 'published',
    ];
    protected $appends = [
        'FriendlyTime',
    ];

    public function user()
    {
        return $this->belongsTo('Wavvve\User', 'user_id');
    }

    public function visitors()
    {
        return $this->hasMany('Wavvve\Visitor', 'passes_uuid', 'uuid');
    }

    public function getFriendlyTimeAttribute()
    {
        return $this->updated_at->diffForHumans();
    }
}
