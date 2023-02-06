<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['username','fullname','email', 'password',
     'phone_number','gender','address_line1','address_line2','address_line3','address_line4','role_id','file_id'];

     protected $hidden = [
        'password', 'remember_token',
    ];

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
