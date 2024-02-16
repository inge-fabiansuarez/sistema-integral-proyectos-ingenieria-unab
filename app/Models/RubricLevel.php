<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RubricLevel
 *
 * @property $id
 * @property $name
 * @property $points
 * @property $rubric_criteria_id
 * @property $created_at
 * @property $updated_at
 *
 * @property RubricCriterion $rubricCriterion
 * @property RubricEvaluation[] $rubricEvaluations
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RubricLevel extends Model
{
    
    static $rules = [
		'name' => 'required',
		'points' => 'required',
		'rubric_criteria_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','points','rubric_criteria_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rubricCriterion()
    {
        return $this->hasOne('App\Models\RubricCriterion', 'id', 'rubric_criteria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rubricEvaluations()
    {
        return $this->hasMany('App\Models\RubricEvaluation', 'rubric_levels_selected_id', 'id');
    }
    

}
