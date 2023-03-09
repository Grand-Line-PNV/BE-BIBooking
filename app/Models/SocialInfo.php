<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'name', 'username', 'fullname','avg_interactions','link','subcribers'
    ];
    protected $table = 'social_infos';
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
}
