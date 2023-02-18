<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignDetail extends Model
{
    use HasFactory;
    protected $table = 'campaign_details';
    protected $fillable = [
        'campaign_id','name','description','price','started_date',
        'ended_date','industry','hashtag','socialChannel','amount','require','interest',
    ];
    public function campaign()
    {
        return $this->belongsTo(\App\Models\Campaign::class);
    }
    public function files()
    {
        return $this->hasMany(\App\Models\File::class);
    }

}
