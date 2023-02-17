<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waterways extends Model
{
    use HasFactory;

    protected $fillable = [
        'wagon_id',
        'name'
    ];

    public function wagon()
    {
        return $this->belongsTo(Wagon::class, 'wagon_id');
    }

    public function water_history()
    {
        return $this->hasMany(WaterHistory::class);
    }
}
