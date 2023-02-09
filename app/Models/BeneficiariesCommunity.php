<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BeneficiariesCommunity
 *
 * @property $id
 * @property $beneficiary_id
 * @property $beneficiary_name
 * @property $community_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Community $community
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BeneficiariesCommunity extends Model
{
    use SoftDeletes;

    static $rules = [
		'beneficiary_id' => 'required',
		'beneficiary_name' => 'required',
		'community_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['beneficiary_id','beneficiary_name','community_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function community()
    {
        return $this->hasOne('App\Models\Community', 'id', 'community_id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value));
    }
}
