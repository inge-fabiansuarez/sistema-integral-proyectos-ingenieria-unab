<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class ProjectField
 *
 * @property $id
 * @property $name
 * @property $type_field
 * @property $created_at
 * @property $updated_at
 *
 * @property EventsHasProjectField[] $eventsHasProjectFields
 * @property ProjectsHasField[] $projectsHasFields
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectField extends Model
{
    use HasSlug;
    protected $table = 'project_fields';
    static $rules = [
        'name' => 'required',
        'type_field' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type_field'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_has_field', 'project_field_id', 'projects_id')
            ->withPivot('value');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_has_project_field', 'project_field_id', 'events_id');
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
