<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 *
 * @property $id
 * @property $title
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property EventsHasProject[] $eventsHasProjects
 * @property ProjectsEvaluator $projectsEvaluator
 * @property ProjectsHasField $projectsHasField
 * @property ProjectAuthor $projectAuthor
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Project extends Model
{

    static $rules = [
        'title' => 'required',
        'description' => 'required',
        'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'cover_image'];


    public function projectAuthors()
    {
        return $this->hasMany(ProjectAuthor::class, 'projects_id');
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

    public function evaluators()
    {
        return $this->belongsToMany(User::class, 'projects_has_evaluators', 'projects_id', 'evaluator_id')
                    ->withPivot('events_id', 'state_evaluation');
    }
}
