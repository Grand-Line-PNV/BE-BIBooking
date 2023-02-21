<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopAge extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'level1', 'level2', 'level3','others'
    ];
    protected $table = 'top_ages';
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

}
