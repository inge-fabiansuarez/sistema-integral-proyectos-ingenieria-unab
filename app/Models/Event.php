<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'opening_date', 'closing_date', 'created_by', 'description', 'img_cover', 'password', 'slug',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function configurationProjectField()
    {
        return $this->hasMany(EventConfigurationProjectField::class, 'events_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'events_id');
    }

    public function evaluationCriteria()
    {
        return $this->hasMany(EvaluationCriteria::class, 'events_id');
    }
}
