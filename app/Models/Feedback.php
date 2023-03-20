<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    
    protected $table = 'feedbacks';

    protected $fillable = [
        'from_type', 'from_account_id', 'content', 'booking_id','to_account_id',
    ];

    public function booking()
    {
        return $this->belongsTo(\App\Models\Booking::class);
    }

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'from_account_id');
    }

}
