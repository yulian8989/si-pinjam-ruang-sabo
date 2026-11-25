<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'description', 'capacity', 'images', 'is_active',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'room_facility' )
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
