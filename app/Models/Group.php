<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 *
 * @property $id
 * @property $name
 * @property $order
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property GroupsService[] $groupsServices
 * @property Location[] $locations
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Group extends Model
{
    use SoftDeletes;

    static $rules = [
		'name' => 'required',
		'order' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','order'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupsServices()
    {
        return $this->hasMany('App\Models\GroupsService', 'group_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany('App\Models\Location', 'group_id', 'id');
    }
    

}
