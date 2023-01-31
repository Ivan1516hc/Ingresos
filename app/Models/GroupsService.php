<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupsService
 *
 * @property $id
 * @property $group_id
 * @property $service_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Group $group
 * @property Service $service
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class GroupsService extends Model
{
    
    static $rules = [
		'group_id' => 'required',
		'service_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id','service_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group()
    {
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service()
    {
        return $this->hasOne('App\Models\Service', 'id', 'service_id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value), 'UTF-8');
    }
}
