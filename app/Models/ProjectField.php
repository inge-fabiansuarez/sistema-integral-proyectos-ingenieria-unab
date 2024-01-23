<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectField extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'value', 'type_field', 'projects_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id');
    }
}
