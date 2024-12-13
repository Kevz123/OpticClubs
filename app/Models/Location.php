<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['sports_name', 'image', 'is_physical', 'shop_name', 'address', 'contact_number', 'equipment_id'];

    public function equipment()
    {
        return $this->hasMany(Equipment::class, 'location_id'); // A location has many equipment
    }
}
