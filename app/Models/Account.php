<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Account extends Authenticatable implements JWTSubject

{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'username', 'fullname', 'email', 'password',
        'role_id','otp','verified'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne(\App\Models\Role::class, 'role_id');
    }
    public function credential()
    {
        return $this->hasOne(\App\Models\Credential::class, 'account_id');
    }
    public function campaigns()
    {
        return $this->hasMany(\App\Models\Campaign::class, 'brand_id');
    }
    public function files()
    {
        return $this->hasMany(\App\Models\File::class);
    }
    public function booking()
    {
        return $this->hasMany(\App\Models\Booking::class, 'influencer_id');
    }
    public function socialInfo()
    {
        return $this->hasMany(\App\Models\SocialInfo::class);
    }
    public function topAges()
    {
        return $this->hasMany(\App\Models\TopAge::class);
    }
    public function genderRatios()
    {
        return $this->hasMany(\App\Models\GenderRatio::class);
    }
    public function cityInfos()
    {
        return $this->hasmany(\App\Models\CityInfo::class);
    }
    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }
    /**
     * Check multiple roles
     * @param array $roles
     */
    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->role()->where("name", $role)->first();
    }
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}
