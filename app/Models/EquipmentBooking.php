<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentBooking extends Model
{
    use HasFactory;

    protected $fillable = ['club_id', 'equipment_id', 'quantity_booked','total_price'];
    

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

}

