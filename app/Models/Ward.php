<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class Ward extends Model
{
    use HasFactory;

    /**
     * Relationship
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }
}