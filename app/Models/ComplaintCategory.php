<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function complaint()
    {
        return $this->hasMany(Complaint::class, 'category_id');
    }
}
