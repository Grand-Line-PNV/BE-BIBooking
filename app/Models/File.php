<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    public function campaign_detail()
    {
        return $this->belongsTo(\App\Models\Campaign_detail::class, 'file_id');
    } 
    public function booking_detail()
    {
        return $this->belongsTo(\App\Models\Booking_detail::class, 'file_id');
    } 
    public function feedback()
    {
        return $this->belongsTo(\App\Models\Feedback::class, 'file_id');
    } 
    public function credential()
    {
        return $this->belongsTo(\App\Models\Credential::class, 'file_id');
    }
}

