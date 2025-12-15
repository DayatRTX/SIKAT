<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    
    use HasFactory, Notifiable;

    




    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
    ];

    




    protected $hidden = [
        'password',
        'remember_token',
    ];

    




    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    


    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    


    public function tasks()
    {
        return $this->hasMany(Report::class, 'assigned_to');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
