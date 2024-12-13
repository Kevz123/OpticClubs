<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id'; // Define the primary key if it's different from the default 'id'

    protected $fillable = [
        'event_name',
        'description',
        'event_date',
        'start_time',
        'club_id',
        'venue_id',
        'image',
        'price_ranges',
    ];

    protected $casts = [
        'event_date' => 'datetime', // Ensure event_date is a Carbon instance
        'price_ranges' => 'array',
    ];

    /**
     * Define the relationship with the Club model.
     */
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id', 'club_id'); // Specify foreign and local keys
    }

    /**
     * Define the relationship with the Participant model.
     */
    public function participants()
    {
        //return $this->hasMany(Participant::class);
        
        return $this->hasMany(Participant::class, 'event_id', 'event_id'); // Specify foreign and local keys
    }
    
    /**
     * Define the relationship with the Membership model through the Participant model.
     */
    public function memberships()
    {
        return $this->hasManyThrough(
            Membership::class,
            Participant::class,
            'event_id',       // Foreign key on participants table
            'membership_id',  // Foreign key on memberships table
            'event_id',       // Local key on events table
            'membership_id'   // Local key on participants table
        );
    }

    /**
     * Define the relationship with the Venue model.
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id', 'venue_id'); // Specify foreign and local keys
    }

    /**
     * Scope to filter events by date (e.g., upcoming events).
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now());
    }

    /**
     * Scope to filter events by club ID.
     */
    public function scopeByClub($query, $clubId)
    {
        return $query->where('club_id', $clubId);
    }


}

