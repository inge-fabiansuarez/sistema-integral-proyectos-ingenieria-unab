<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEvaluator extends Model
{
    use HasFactory;
    protected $fillable = [
        'projects_id', 'users_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
