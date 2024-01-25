<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'opening_date', 'closing_date', 'created_by', 'description', 'img_cover', 'password', 'slug',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'events_has_projects', 'events_id', 'projects_id');
    }

    public function projectFields()
    {
        return $this->belongsToMany(ProjectField::class, 'events_has_project_field', 'events_id', 'project_field_id');
    }
}
