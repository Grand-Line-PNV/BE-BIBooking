<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksLink extends Model
{
    use HasFactory;

    protected $table = 'tasks_links';

    protected $fillable = [
        'booking_id', 'link', 'description', 'submitted_date'
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Booking::class);
    }
}
