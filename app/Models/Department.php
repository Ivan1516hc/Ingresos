<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 *
 * @property $id
 * @property $level
 * @property $name
 * @property $direction
 * @property $dependence
 * @property $created_at
 * @property $updated_at
 *
 * @property Location[] $locations
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Department extends Model
{
    
    static $rules = [
		'level' => 'required',
		'name' => 'required',
		'direction' => 'required',
		'dependence' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['level','name','direction','dependence'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany('App\Models\Location', 'department_id', 'id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value), 'UTF-8');
    }

}
