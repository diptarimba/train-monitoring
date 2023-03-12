<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outflow extends Model
{
    use HasFactory;

    protected $fillable = [
        'water_way_id',
        'wagon_id',
        'value'
    ];

    public function water_way()
    {
        return $this->belongsTo(Waterways::class, 'water_way_id');
    }

    public function wagon()
    {
        return $this->belongsTo(Wagon::class, 'wagon_id');
    }
}
