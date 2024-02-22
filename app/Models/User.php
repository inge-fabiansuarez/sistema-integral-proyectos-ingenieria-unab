<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'about_me',
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
    ];
    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'events_has_registered_users', 'users_id', 'events_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_has_evaluators', 'evaluator_id', 'projects_id')
            ->withPivot('events_id', 'state_evaluation');
    }
    public function evaluators(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'projects_has_evaluators', 'evaluator_id', 'projects_id')
            ->wherePivot('state_evaluation', 1);
    }
}
