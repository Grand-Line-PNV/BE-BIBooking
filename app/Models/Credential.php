<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'nickname', 'dob','fullname',
        'booking_price', 'industry', 'content_topic', 'experiences','website',
        'phone_number', 'gender', 'address_line1', 'address_line2', 'address_line3', 
        'address_line4','job','description','title_for_job','brand_name'
    ];
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
    public function files()
    {
        return $this->hasMany(\App\Models\File::class);
    }
}
