<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Community
 *
 * @property $id
 * @property $name
 * @property $location_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property BeneficiariesCommunity[] $beneficiariesCommunities
 * @property Location $location
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Community extends Model
{
    use SoftDeletes;

    static $rules = [
		'name' => 'required',
		'location_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','location_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beneficiariesCommunities()
    {
        return $this->hasMany('App\Models\BeneficiariesCommunity', 'community_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne('App\Models\Location', 'id', 'location_id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value));
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value));
    }
}
