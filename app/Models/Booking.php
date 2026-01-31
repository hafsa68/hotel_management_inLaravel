<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // These must match the columns in your migration exactly
    protected $fillable = [
        'rooms_id',      // Room Type ID
        'room_nos_id',   // Specific Room ID
        'guest_name',
        'guest_email',
        'phone',
        'check_in',
        'check_out',
        'nights',
        'total_price',
        'status',
    ];

    // Optional: Add relationships if you want to access room details easily later
    public function roomType()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }

    public function roomNumber()
    {
        return $this->belongsTo(RoomNo::class, 'room_nos_id');
    }
}