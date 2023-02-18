<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;
    protected $table = 'booking_details';

    public function booking_detail()
    {
        return $this->belongsTo(\App\Models\Booking::class, 'booking_id');
    }
    public function payment()
    {
        return $this->hasOne(\App\Models\Payment::class, 'payment_id');
    }
    public function file()
    {
        return $this->hasMany(\App\Models\File::class, 'file_id');
    }
}
