<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'brand_id', 'campaign_status', 'name', 'description', 'price', 'started_date',
        'ended_date', 'industry', 'hashtag', 'socialChannel', 'amount', 'require', 'interest', 'applied_number'
    ];
    use HasFactory;

    public const STATUS_APPLY = 'apply';
    public const STATUS_APPROVE = 'approve';
    public const STATUS_SUBMIT = 'submit';
    public const STATUS_EVALUATE = 'evaluate';
    public const STATUS_CLOSED = 'closed';

    public const CAMPAIGN_STATUS = [
        self::STATUS_APPLY,
        self::STATUS_APPROVE,
        self::STATUS_SUBMIT,
        self::STATUS_EVALUATE,
        self::STATUS_CLOSED,
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
    public function files()
    {
        return $this->hasMany(\App\Models\File::class);
    }
    public function booking()
    {
        return $this->hasOne(\App\Models\Booking::class);
    }

    public function scopeKeyword($query, $request)
    {
        if ($request->has('keyword')) {
            $query->where('name', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('hashtag', 'LIKE', '%' . $request->keyword . '%');
        }
        return $query;
    }

    public function scopeIndustry($query, $request)
    {
        if ($request->has('industry')) {
            $query->where('industry', $request->industry);
        }
        return $query;
    }
    public function scopeMinCast($query, $request)
    {
        if ($request->has('minCast')) {
            $query->where('price', '>=', $request->minCast);
        }
        return $query;
    }
    public function scopeMaxCast($query, $request)
    {
        if ($request->has('maxCast')) {
            $query->where('price', '<=', $request->maxCast);
        }
        return $query;
    }
}
