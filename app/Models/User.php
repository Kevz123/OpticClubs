<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',     
        'gender',            
        'employed_company',  
        'employee_id',  
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date:Y-m-d',
        ];
    }

    public function joinedClubs()
    {
        return $this->belongsToMany(Club::class, 'memberships', 'user_id', 'club_id')
                    ->withPivot('membership_id', 'join_date', 'membership_fee') // Include pivot columns
                    ->withTimestamps();
    }

    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'memberships', 'id', 'club_id') // Use correct foreign key names
                    ->withPivot('join_date', 'membership_fee') // Additional fields in pivot table
                    ->withTimestamps(); // Make sure timestamps are handled
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'membership_id', 'id');
    }
    public function membership()
    {
        return $this->hasOne(Membership::class, 'user_id', 'id'); // Adjust foreign key if necessary
    }

    

}
