<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Room;
use App\Models\RoomNo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['rooms_id', 'room_nos_id', 'check_in', 'check_out', 'guest_name', 'guest_email', 'status'];

public function roomType() {
    return $this->belongsTo(Room::class, 'rooms_id');
}

public function roomNumber() {
    return $this->belongsTo(RoomNo::class, 'room_nos_id');
}
}
