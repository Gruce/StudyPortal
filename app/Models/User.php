<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    public function Institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function Group()
    {
        return $this->belongsToMany(Group::class);
    }

    public function Timetable()
    {
        return $this->morphMany(Timetable::class, 'timetableable');
    }

    public function Assignment()
    {
        return $this->belongsToMany(Assignment::class);
    }

    public function Subject()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function Post()
    {
        return $this->hasMany(Post::class);
    }

    public function Comment()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_tutor' => 'boolean',
        'is_admin' => 'boolean',
        'is_moderator' => 'boolean'
    ];
}
