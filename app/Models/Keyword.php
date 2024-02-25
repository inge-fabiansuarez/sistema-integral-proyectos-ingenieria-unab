<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Keyword
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property KeywordProject $keywordProject
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Keyword extends Model
{
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function keywordProject()
    {
        return $this->hasOne('App\Models\KeywordProject', 'keyword_id', 'id');
    }
    

}
