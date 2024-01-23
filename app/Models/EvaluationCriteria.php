<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationCriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'events_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    public function evaluations()
    {
        return $this->hasMany(ProjectEvaluation::class, 'evaluation_criteria_id');
    }
}
