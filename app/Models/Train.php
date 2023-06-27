<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $append = [
        'water_usage'
    ];

    public function wagon()
    {
        return $this->hasMany(Wagon::class);
    }

    public function getWaterUsageAttribute()
    {
        $waterUsage = $this->wagon->map(function($query){
                return $query->water_way->map(function($query){
                    return $query->outflow->sum('value');
                })->sum();
            })->sum();

        return $waterUsage;

    }
}
