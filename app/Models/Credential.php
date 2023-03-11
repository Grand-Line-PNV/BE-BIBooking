<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'nickname', 'dob', 'fullname',
        'booking_price', 'industry', 'content_topic', 'experiences', 'website',
        'phone_number', 'gender', 'address_line1', 'address_line2', 'address_line3', 
        'address_line4','job', 'description', 'title_for_job', 'brand_name', 'ward_code'
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function files()
    {
        return $this->hasMany(\App\Models\File::class);
    }

    public function scopeKeyword($query, $request)
    {
        if ($request->has('keyword')) {
            $query->orWhere('nickname', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('fullname', 'LIKE', '%' . $request->keyword . '%');
        }

        return $query;
    }

    public function scopeGender($query, $request)
    {
        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }

        return $query;
    }

    public function scopeJob($query, $request)
    {
        if ($request->has('job')) {
            $query->orWhere('job', $request->job);
        }

        return $query;
    }
    
    public function scopeMinCast($query, $request)
    {
        if ($request->has('minCast')) {
            $query->orWhere('booking_price', '>=', $request->minCast);
        }

        return $query;
    }

    public function scopeMaxCast($query, $request)
    {
        if ($request->has('maxCast')) {
            $query->orWhere('booking_price', '<=', $request->maxCast);
        }

        return $query;
    }
}
