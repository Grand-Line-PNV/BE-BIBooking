<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'nickname', 'dob', 'followers',
        'bookingPrice', 'industry', 'contentTopic', 'marialStatus', 'startedWork', 'file_id', 'link','brandName','website'
    ];
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'account_id');
    }
    public function file()
    {
        return $this->hasMany(\App\Models\File::class, 'file_id');
    }
}
