<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    
    protected $table = 'feedbacks';

    protected $fillable = [
        'from_type', 'from_account_id', 'content', 'booking_id',
    ];

    public function booking()
    {
        return $this->belongsTo(\App\Models\Booking::class);
    }

    public function file()
    {
        return $this->hasMany(\App\Models\File::class);
    }
}
