<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventConfigurationProjectField extends Model
{
    use HasFactory;
    protected $table = 'events_configuration_project_fields';
    protected $fillable = [
        'name', 'type_field', 'events_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }
}
