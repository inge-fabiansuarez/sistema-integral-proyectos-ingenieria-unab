<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Event
 *
 * @property $id
 * @property $name
 * @property $opening_date
 * @property $closing_date
 * @property $created_by
 * @property $description
 * @property $img_cover
 * @property $password
 * @property $slug
 * @property $created_at
 * @property $updated_at
 *
 * @property EventsHasProject $eventsHasProject
 * @property EventsHasProjectField $eventsHasProjectField
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Event extends Model
{
    use HasSlug;
    static $rules = [
        'name' => 'required|string|max:255',
        'opening_date' => 'required|date',
        'closing_date' => 'required|date',
        'description' => 'required|string',
        'img_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'password' => 'required|min:4',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'opening_date', 'closing_date', 'created_by', 'description', 'img_cover', 'slug', 'password'];


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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
