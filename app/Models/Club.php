<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Club extends Model
{
    use HasFactory;

    // Define the table if it's not the plural of the model name
    protected $table = 'clubs';
    protected $primaryKey = 'club_id';

    // Define the fillable attributes
    protected $fillable = [
        'name',          // The name of the club
        'description',
        'club_type',
        'physical_type',
        'main_image',
        'monthly_practice_timetable',
    ];

    /**
     * Define the many-to-many relationship with the User model through memberships.
     */
    public function users()
{
    return $this->belongsToMany(
        User::class,
        'memberships',      // Pivot table
        'club_id',          // Foreign key on memberships
        'user_id',          // Foreign key on users
        'club_id',          // Local key on clubs
        'id'                // Local key on users
    )->withPivot('membership_id', 'join_date', 'membership_fee') // Include other fields in the pivot
     ->withTimestamps(); // Add timestamps for pivot table
}


    /**
     * Scope to filter physical clubs.
     */
    public function scopePhysical($query)
    {
        return $query->where('physical_type', 'physical');
    }

    /**
     * Scope to filter non-physical clubs.
     */
    public function scopeNonPhysical($query)
    {
        return $query->where('physical_type', 'non-physical');
    }

    /**
     * Define the one-to-many relationship with the Event model.
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'club_id');
    }

    /**
     * Define the one-to-many relationship with Membership model.
     */
    public function memberships()
    {
        return $this->hasMany(Membership::class, 'club_id', 'club_id');
    }

    /**
     * Define a relationship to fetch all participants through events.
     */
    public function participants()
    {
        return $this->hasManyThrough(
            Participant::class,
            Event::class,
            'club_id',       // Foreign key on events table
            'event_id',      // Foreign key on participants table
            'club_id',       // Local key on clubs table
            'event_id'       // Local key on events table
        );
    }

    public function bookings()
{
    return $this->hasMany(EquipmentBooking::class, 'club_id');
}

}
