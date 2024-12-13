<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'quantity_available', 'price'];
    protected $table = 'equipment';

    public function bookings()
    {
        return $this->hasMany(EquipmentBooking::class, 'equipment_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id'); // An equipment belongs to one location
    }


}
