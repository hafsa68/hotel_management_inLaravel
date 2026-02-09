<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'rooms_id',
        'room_nos_id',
        'guest_name',
        'guest_email',
        'phone',
        'check_in',
        'check_out',
        'nights',
        'total_price',
        'status',
    ];
    
    // ✅ RoomNo এর সাথে সম্পর্ক - রুম নম্বরের জন্য
    public function roomNo()
    {
        return $this->belongsTo(RoomNo::class, 'room_nos_id');
    }
    
    // ✅ Room (type) এর সাথে সম্পর্ক - রুম টাইপ/বিস্তারিত জন্য
    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }
    
    // ✅ Optional: alias হিসেবে roomType মেথড (যদি ব্লেডে roomType লাগে)
    public function roomType()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }
    
    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

}