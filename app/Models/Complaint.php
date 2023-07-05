<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'wagon_id',
        'category_id',
        'name',
        'status',
        'content'
    ];

    public function wagon()
    {
        return $this->belongsTo(Wagon::class, 'wagon_id');
    }

    public function category()
    {
        return $this->belongsTo(ComplaintCategory::class, 'category_id');
    }
}
