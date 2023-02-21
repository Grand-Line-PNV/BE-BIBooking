<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'name', 'percentage'
    ];
    protected $table = 'city_infos';
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
}
