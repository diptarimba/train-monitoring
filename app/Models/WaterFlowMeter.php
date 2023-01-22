<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterFlowMeter extends Model
{
    use HasFactory;

    protected $fillable = [
        'wagon_id',
        'discharge',
        'volume'
    ];

    public function wagon()
    {
        return $this->belongsTo(Wagon::class, 'wagon_id');
    }
}
