<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowMeter extends Model
{
    use HasFactory;

    protected $fillable = [
        'wagon_id',
        'discharge',
        'volume'
    ];
}
