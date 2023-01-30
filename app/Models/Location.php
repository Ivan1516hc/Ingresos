<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Location
 *
 * @property $id
 * @property $location
 * @property $name
 * @property $group_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Group $group
 * @property Transaction[] $transactions
 * @property User[] $users
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Location extends Model
{
    use SoftDeletes;

    static $rules = [
		'location' => 'required',
		'name' => 'required',
		'group_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['location','name','group_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group()
    {
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'location_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'location_id', 'id');
    }
    

}
