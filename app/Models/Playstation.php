<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playstation extends Model
{
    protected $table = 'playstations';

    protected $fillable = [
        'name',
        'image',
        'playstation_type',
        'desc',
        'price',
        'status'
    ];

    public function listgame()
    {
        return $this->belongsToMany(listgame::class, 'playstation_listgames', 'playstation_id', 'listgame_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
