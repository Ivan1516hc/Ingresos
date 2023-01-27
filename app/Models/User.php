<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property $id
 * @property $type
 * @property $name
 * @property $second_name
 * @property $last_name
 * @property $mother_last_name
 * @property $town
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $remember_token
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Nna[] $nnas
 * @property Point[] $points
 * @property UserReport[] $userReports
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Model
{
    
    static $rules = [
		'name' => 'required',
		'last_name' => 'required',
		'mother_last_name' => 'required',
		'town' => 'required',
		'email' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type','name','second_name','last_name','mother_last_name','town','email','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nnas()
    {
        return $this->hasMany('App\Models\Nna', 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points()
    {
        return $this->hasMany('App\Models\Point', 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userReports()
    {
        return $this->hasMany('App\Models\UserReport', 'user_id', 'id');
    }
    

}
