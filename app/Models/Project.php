<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description',
    ];

    public function projectAuthors()
    {
        return $this->hasMany(ProjectAuthor::class, 'projects_id');
    }

    public function projectsEvaluator()
    {
        return $this->hasMany(ProjectEvaluator::class, 'projects_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_has_projects', 'projects_id', 'events_id');
    }

    public function projectFields()
    {
        return $this->belongsToMany(ProjectField::class, 'projects_has_field', 'projects_id', 'project_field_id')
            ->withPivot('value');
    }
}
