<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'booking_id', 'bank_name', 'date', 'number'
    ];

    public function booking()
    {
        return $this->belongsTo(\App\Models\Booking::class);
    }
}