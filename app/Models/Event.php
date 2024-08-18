<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'event_end_time', 
        'location',
        'is_confirmed',
        'user_id',
        'image',
        'quota', 
        'registered_participants', 
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    // accessor untuk event_date
    public function getEventDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value); // Mengonversi string menjadi objek Carbon
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_registrations', 'event_id', 'user_id')
            ->withTimestamps();
    }
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class, 'event_id');
    }
}
