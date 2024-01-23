<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEvaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'score', 'projects_id', 'evaluation_criteria_id', 'users_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id');
    }

    public function criteria()
    {
        return $this->belongsTo(EvaluationCriteria::class, 'evaluation_criteria_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
