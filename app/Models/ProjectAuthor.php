<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAuthor extends Model
{
    use HasFactory;

    public $incrementing = true;

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
