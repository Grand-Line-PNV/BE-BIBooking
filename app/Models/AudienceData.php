<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudienceData extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'female', 'male', 'others','city1','city2','city3','city4', 'age1','age2','age3','age4'
    ];
    protected $table = 'audience_data';

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
}
