<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAudiometry extends Model
{
    use HasFactory;

    protected $fillable = [
        'frecuency',
        'left_hertz',
        'right_hertz',
        'audiometry_id'
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function audiometry()
    {
        return $this->belongsTo(Audiometry::class, 'audiometry_id');
    }
}
