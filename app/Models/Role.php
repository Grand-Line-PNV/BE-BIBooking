<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];

    public const ROLE_BRAND = 1;
    public const ROLE_INFLUENCER = 2;
    public const ROLE_ADMIN = 3;

    public const ROLES = [
        self::ROLE_BRAND,
        self::ROLE_INFLUENCER,
        self::ROLE_ADMIN,
    ];

    public function account()
    {
        return $this->hasMany(\App\Models\Account::class);
    } 
}
