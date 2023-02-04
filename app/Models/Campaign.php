<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'brand_id');
    }
    public function campaign_detail()
    {
        return $this->hasOne(\App\Models\Campaign_detail::class, 'campaign_id');
    }
    public function booking_campaign()
    {
        return $this->hasMany(\App\Models\Booking_campaign::class, 'campaign_id');
    }
}
