<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'tranfer_type', 'description', 'booking_id', 'bank_account', 'date', 'number'
    ];

    public function files()
    {
        return $this->hasMany(\App\Models\File::class);
    }

    public function booking()
    {
        return $this->belongsTo(\App\Models\Booking::class);
    }
}