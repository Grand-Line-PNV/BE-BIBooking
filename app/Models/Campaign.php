<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'brand_id','campaign_status',
    ];
    use HasFactory;

    // "apply","approve","submit","evaluate","closed"
    public const STATUS_APPLY = 'apply';
    public const STATUS_APPROVE = 'approve';
    public const STATUS_SUBMIT= 'submit';
    public const STATUS_EVALUATE = 'evaluate';
    public const STATUS_CLOSED = 'closed';

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'brand_id');
    }
    public function campaign_detail()
    {
        return $this->hasOne(\App\Models\CampaignDetail::class);
    }
    public function booking_campaign()
    {
        return $this->hasMany(\App\Models\Booking_campaign::class, 'campaign_id');
    }
}
