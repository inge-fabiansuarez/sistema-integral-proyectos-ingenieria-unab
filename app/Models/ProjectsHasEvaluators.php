<?php

namespace App\Models;

use App\Models\Project;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;

class ProjectsHasEvaluators extends Model
{
    protected $table = 'projects_has_evaluators';
    protected $primaryKey = 'id';
    protected $fillable = ['projects_id', 'evaluator_id', 'state_evaluation'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    public function getTotalEvaluationPoints(User $evaluator)
    {
        $totalPointsAllLevels = 0;
        $totalPointsEvaluation = 0;
        $rubric = $this->event->rubric;

        foreach ($rubric->rubricCriterias as $criteria) {
            foreach ($criteria->rubricLevels as $level) {
                $totalPointsAllLevels += $level->points;
            }
        }
        $rubricEvaluations = RubricEvaluation::where('projects_id', $this->project->id)->where('evaluador_id', $evaluator->id)->get();
        foreach ($rubricEvaluations as $evalucion) {
            $totalPointsEvaluation +=  $evalucion->rubricLevel->points;
        }
        return ($totalPointsEvaluation * $rubric->total_rating) / $totalPointsAllLevels;
    }
}
