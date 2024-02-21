<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectsHasEvaluators extends Controller
{
    protected $table = 'projects_has_evaluators';
    protected $primaryKey = ['projects_id', 'evaluator_id'];
    public $incrementing = false;
    protected $fillable = ['projects_id', 'evaluator_id', 'state_evaluation'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
