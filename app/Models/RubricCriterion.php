<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RubricCriterion
 *
 * @property $id
 * @property $name
 * @property $rubrics_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Rubric $rubric
 * @property RubricEvaluation[] $rubricEvaluations
 * @property RubricLevel[] $rubricLevels
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RubricCriterion extends Model
{
    
    static $rules = [
		'name' => 'required',
		'rubrics_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','rubrics_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rubric()
    {
        return $this->hasOne('App\Models\Rubric', 'id', 'rubrics_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rubricEvaluations()
    {
        return $this->hasMany('App\Models\RubricEvaluation', 'rubric_criteria_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rubricLevels()
    {
        return $this->hasMany('App\Models\RubricLevel', 'rubric_criteria_id', 'id');
    }
    

}
