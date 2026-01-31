<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'details',
        'sku',
        'stock',
        
        'price',
        'image',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
