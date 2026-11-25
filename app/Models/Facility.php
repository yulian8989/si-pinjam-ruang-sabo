<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['name', 'information'];
    
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_facility');
    }
}
