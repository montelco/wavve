<?php

namespace Wavvve;

use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    protected $table = 'passes';
    protected $guarded = 'id';
    protected $fillable = [
        'header_foreground_image', 'header_background_image', 'title', 'expiry', 'strip_background_image', 'primary_field', 'secondary_field', 'coupon_full_background_image', 'barcode_value', 'cashier_helper', 'uuid', 'template_number', 'theme', 'published', 'one_time_redemption',
    ];
    protected $appends = [
        'FriendlyTime', 'CantRedeem',
    ];

    public function user()
    {
        return $this->belongsTo('Wavvve\User', 'user_id');
    }

    public function visitors()
    {
        return $this->hasMany('Wavvve\Visitor', 'passes_uuid', 'uuid')->select(['passes_uuid', 'visitor_cookie', 'created_at', 'updated_at']);
    }

    public function getFriendlyTimeAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function getCantRedeemAttribute()
    {
        if (isset($_COOKIE['redeemed'])) {
            if (Redemption::where('redemption_id', $_COOKIE['redeemed'])->where('passes_uuid', $this->uuid)->exists()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
