<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'train_id',
        'category_id',
        'name',
        'content'
    ];

    public function wagon()
    {
        return $this->belongsTo(Wagon::class, 'train_id');
    }

    public function category()
    {
        return $this->belongsTo(ComplaintCategory::class, 'category_id');
    }
}
