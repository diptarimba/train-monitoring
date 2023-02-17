<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'water_way_id',
        'volume'
    ];

    public function water_way(){
        return $this->belongsTo(Waterways::class, 'water_way_id');
    }
}
