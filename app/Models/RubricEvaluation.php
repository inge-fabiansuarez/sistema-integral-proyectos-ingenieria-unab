<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RubricEvaluation
 *
 * @property $id
 * @property $projects_id
 * @property $evaluador_id
 * @property $rubric_criteria_id
 * @property $rubric_levels_selected_id
 * @property $comments
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @property RubricCriterion $rubricCriterion
 * @property RubricLevel $rubricLevel
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RubricEvaluation extends Model
{

    static $rules = [
        'projects_id' => 'required',
        'evaluador_id' => 'required',
        'rubric_criteria_id' => 'required',
        'rubric_levels_selected_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['projects_id', 'evaluador_id', 'rubric_criteria_id', 'rubric_levels_selected_id', 'comments'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'projects_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rubricCriterion()
    {
        return $this->hasOne('App\Models\RubricCriterion', 'id', 'rubric_criteria_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rubricLevel()
    {
        return $this->hasOne('App\Models\RubricLevel', 'id', 'rubric_levels_selected_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function evaluator()
    {
        return $this->hasOne('App\Models\User', 'id', 'evaluador_id');
    }


}
