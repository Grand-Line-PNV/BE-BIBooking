<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'influencer_id','status','campaign_id'
    ];
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'influencer_id');
    }
    public function feedback()
    {
        return $this->hasMany(\App\Models\Feedback::class, 'booking_id');
    }
    public function booking_detail()
    {
        return $this->hasOne(\App\Models\Booking_detail::class, 'booking_id');
    }

}
