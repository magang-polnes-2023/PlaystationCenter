<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listgame extends Model
{
    protected $table = 'listgames';

    protected $casts = [
        'playstation_id' => 'array'
    ];

    protected $fillable = ['name'];

    public function playstations()
    {
        return $this->belongsToMany(Playstation::class, 'playstation_listgames');
    }
}
