<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public function role()
    {
        return $this->hasOne(\App\Models\Role::class, 'role_id');
    } 
    public function file()
    {
        return $this->hasMany(\App\Models\File::class, 'file_id');
    }
    public function credential()
    {
        return $this->hasOne(\App\Models\Credential::class, 'account_id');
    }
    public function campaign()
    {
        return $this->hasMany(\App\Models\Campaign::class, 'brand_id');
    }
    public function booking()
    {
        return $this->hasMany(\App\Models\Booking::class, 'influencer_id');
    }
}
