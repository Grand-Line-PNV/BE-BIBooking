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

    public const ROLE_ADMIN = 0;

    public const ROLE_BRAND = 1;
    
    public const ROLE_INFLUENCER = 2;

    public const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_BRAND,
        self::ROLE_INFLUENCER,
    ];

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    } 
}
