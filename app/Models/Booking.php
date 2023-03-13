<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public const STATUS_WAITING = 'waiting';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_DOING = 'in_progress';
    public const STATUS_DONE = 'done';
    public const STATUS_CANCEL = 'cancel';
    public const STATUS_REJECT = 'reject';
    public const STATUS_PAID = 'paid';

    public const BOOKING_STATUS = [
        self::STATUS_WAITING,
        self::STATUS_CONFIRMED,
        self::STATUS_DOING,
        self::STATUS_DONE,
        self::STATUS_CANCEL,
        self::STATUS_REJECT,
        self::STATUS_PAID,
    ];


    protected $fillable = [
        'influencer_id', 'status', 'campaign_id', 'started_date', 'ended_date', 'payment_status'
    ];

    public function influencer()
    {
        return $this->belongsTo(\App\Models\Account::class, 'influencer_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(\App\Models\Feedback::class);
    }

    public function payment()
    {
        return $this->hasOne(\App\Models\Payment::class);
    }

    public function campaign()
    {
        return $this->belongsTo(\App\Models\Campaign::class);
    }

    public function tasksLinks()
    {
        return $this->hasMany(\App\Models\TasksLink::class);
    }
}
