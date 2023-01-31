<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 *
 * @property $id
 * @property $name
 * @property $username
 * @property $password
 * @property $post
 * @property $remember_token
 * @property $profile_id
 * @property $location_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property CancellationHistory[] $cancellationHistories
 * @property Location $location
 * @property PartialPayment[] $partialPayments
 * @property Profile $profile
 * @property ReprintHistory[] $reprintHistories
 * @property Transaction[] $transactions
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Model
{
    use SoftDeletes;

    static $rules = [
		'name' => 'required',
		'username' => 'required',
		'post' => 'required',
		'profile_id' => 'required',
		'location_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','username','post','profile_id','location_id','password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cancellationHistories()
    {
        return $this->hasMany('App\Models\CancellationHistory', 'user_id', 'id');
    }

    public function cancellationHistoriesAuthorized()
    {
        return $this->hasMany('App\Models\CancellationHistory', 'authorized_user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne('App\Models\Location', 'id', 'location_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partialPayments()
    {
        return $this->hasMany('App\Models\PartialPayment', 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile', 'id', 'profile_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reprintHistories()
    {
        return $this->hasMany('App\Models\ReprintHistory', 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'user_id', 'id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value) && $key != 'password')
            $this->attributes[$key] = trim(mb_strtoupper($value),'UTF-8');
    }
}
