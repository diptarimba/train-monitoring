<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wagon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'train_id'
    ];

    public function train()
    {
        return $this->belongsTo(Train::class, 'train_id');
    }

    public function water_way()
    {
        return $this->hasMany(Waterways::class);
    }

    public function water_level()
    {
        return $this->hasMany(WaterLevel::class);
    }

    public function complaint()
    {
        return $this->hasMany(Complaint::class);
    }

    public function outflow()
    {
        return $this->hasMany(Outflow::class);
    }
}
