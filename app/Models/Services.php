<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'name', 'description'
    ];
    protected $table = 'series';
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
}
