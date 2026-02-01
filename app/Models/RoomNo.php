<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomNo extends Model
{
    use HasFactory;
     protected $fillable = ['room_id', 'room_number', 'status'];
      public function roomType() {
    return $this->belongsTo(Room::class, 'room_id');
}


 public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_nos_id');
    }
}