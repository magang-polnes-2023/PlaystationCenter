<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
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
