<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'nim', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_registrations', 'user_id', 'event_id')
            ->withTimestamps();
    }
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class, 'user_id');
    }
}
