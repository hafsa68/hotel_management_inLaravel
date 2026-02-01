<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    protected $table = 'hotel_bookings';
    
    protected $fillable = [
        'booking_reference',
        'room_id',
        'user_id',
        'check_in',
        'check_out',
        'adults',
        'children',
        'rooms',
        'nights',
        'room_price',
        'total_amount',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'special_requests',
        'payment_method',
        'payment_status',
        'booking_status',
        'notes'
    ];
    
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}