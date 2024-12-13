<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    use HasFactory;

    protected $primaryKey = 'membership_id';  // Define the custom primary key
    public $incrementing = true; // Set true if it's auto-incrementing
    protected $keyType = 'int';  // Set the key type

    // The attributes that are mass assignable
    protected $fillable = [
        'user_id',         // Foreign key for the user
        'club_id',         // Foreign key for the club
        'join_date',       // Additional attribute
        'membership_fee',  // Additional attribute
    ];

    /**
     * Define the relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  // Specify foreign key
    }

    /**
     * Define the relationship with the Club model.
     */
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id', 'club_id');  // Specify foreign key
    }

    /**
     * Define the relationship with the Participant model.
     */
    public function participants()
    {
        return $this->hasMany(Participant::class, 'membership_id'); // Specify foreign key
    }

    /**
     * Define the relationship with the Event model through participants.
     */
    public function events()
    {
        return $this->hasManyThrough(
            Event::class,
            Participant::class,
            'membership_id',  // Foreign key on participants table
            'event_id',       // Foreign key on events table
            'membership_id',  // Local key on memberships table
            'event_id'        // Local key on participants table
        );
    }
}
