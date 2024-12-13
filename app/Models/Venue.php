<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venue extends Model
{
    use HasFactory;

    protected $primaryKey = 'venue_id'; 

    protected $fillable = ['venue_name', 'location', 'capacity', 'picture'];

    // Define the relationship with the Event model
    public function events()
    {
        return $this->hasMany(Event::class, 'venue_id');
    }

    // Define the relationship with the Booking model
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'venue_id');
    }
}
