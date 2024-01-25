<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectField extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type_field',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_has_field', 'project_field_id', 'projects_id')
            ->withPivot('value');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_has_project_field', 'project_field_id', 'events_id');
    }
}
