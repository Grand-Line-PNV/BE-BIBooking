<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'url', 'file_type', 'name', 'path','campaign_detail_id','account_id'
    ];
    public function feedback()
    {
        return $this->belongsTo(\App\Models\Feedback::class, 'file_id');
    }
    public function credential()
    {
        return $this->belongsTo(\App\Models\Credential::class, 'file_id');
    }
    public function campaign()
    {
        return $this->belongsTo(\App\Models\Campaign::class);
    }
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
}
