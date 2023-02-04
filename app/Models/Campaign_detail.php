<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign_detail extends Model
{
    use HasFactory;
    public function campaign()
    {
        return $this->belongsTo(\App\Models\Campaign::class, 'campaign_id');
    }
    public function file()
    {
        return $this->hasMany(\App\Models\File::class, 'file_id');
    }
}
