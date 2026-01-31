<?php

namespace App\Models;
use App\Models\Room_no;
use App\Models\Room_no as ModelsRoom_no;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
       protected $fillable = [
        'name', 'slug', 'room_type', 'fare', 'offer_fare', 
        'cancellation_fee', 'total_adult', 'total_child', 
        'size', 'amenities', 'facilities', 'keywords', 
        'description', 'cancellation_policy', 'main_image', 
        'gallery_images', 'is_featured', 'status'
    ];

    
    protected $casts = [
        'gallery_images' => 'array',
    ];
        public function roomNumbers() {
    return $this->hasMany(RoomNo::class, 'room_id');
}
}
