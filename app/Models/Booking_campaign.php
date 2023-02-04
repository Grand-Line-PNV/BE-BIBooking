<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_campaign extends Model
{
    use HasFactory;
    public function campaign()
    {
        return $this->belongsTo(\App\Models\Campaign::class, 'campaign_id');
    }
    public function booking()
    {
        return $this->belongsTo(\App\Models\Booking::class, 'booking_id');
    }
}
