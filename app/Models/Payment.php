<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function booking_detail()
    {
        return $this->belongsTo(\App\Models\Booking_detail::class, 'payment_id');
    }
}
