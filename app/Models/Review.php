<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'review_id';  // Define the primary key if it's different from the default 'id'

    // Define the relationship with the Membership model
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id');
    }

    // Define the relationship with the Club model
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
