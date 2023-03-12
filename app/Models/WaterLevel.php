<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'wagon_id',
        'value'
    ];

    public function wagon()
    {
        return $this->belongsTo(Wagon::class);
    }
}
