<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';  // Define the primary key if it's different from the default 'id'

    // Define the relationship with the Club model
    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    // Define the relationship with the Venue model
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
