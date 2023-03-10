<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Profile
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property ProfilesUser[] $profilesUsers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Profile extends Model
{
    use SoftDeletes;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profilesUsers()
    {
        return $this->hasMany('App\Models\ProfilesUser', 'profile_id', 'id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value));
    }
}
