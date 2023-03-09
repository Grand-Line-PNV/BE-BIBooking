<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenderRatio extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'male', 'female', 'others'
    ];
    protected $table = 'gender_ratios';
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
}
