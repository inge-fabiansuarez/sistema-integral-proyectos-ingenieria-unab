<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'events_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    public function fields()
    {
        return $this->hasMany(ProjectField::class, 'projects_id');
    }

    public function authors()
    {
        return $this->hasMany(ProjectAuthor::class, 'projects_id');
    }

    public function evaluations()
    {
        return $this->hasMany(ProjectEvaluation::class, 'projects_id');
    }

    public function evaluators()
    {
        return $this->belongsToMany(User::class, 'projects_evaluator', 'projects_id', 'users_id')->withTimestamps();
    }
}
