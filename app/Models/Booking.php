<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'playstation_id',
        'user_id',
        'booking_code',
        'booking_date',
        'booking_duration',
        'start_time',
        'end_time',
        'total_pay',
        'payment',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playstation()
    {
        return $this->belongsTo(Playstation::class);
    }
}
