<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rubric
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $total_rating
 * @property $created_at
 * @property $updated_at
 *
 * @property RubricCriterion[] $rubricCriterias
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Rubric extends Model
{

    static $rules = [
        'name' => 'required',
        'description' => 'required',
        'total_rating' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'description', 'total_rating'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rubricCriterias()
    {
        return $this->hasMany('App\Models\RubricCriterion', 'rubrics_id', 'id');
    }
}
