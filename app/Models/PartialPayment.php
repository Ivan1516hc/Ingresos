<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PartialPayment
 *
 * @property $id
 * @property $beneficiary_id
 * @property $beneficiary_name
 * @property $service_id
 * @property $transaction_id
 * @property $user_id
 * @property $payment
 * @property $partiality
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Service $service
 * @property Transaction $transaction
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PartialPayment extends Model
{
    
    static $rules = [
		'beneficiary_id' => 'required',
		'beneficiary_name' => 'required',
		'service_id' => 'required',
		'transaction_id' => 'required',
		'user_id' => 'required',
		'payment' => 'required',
		'partiality' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['beneficiary_id','beneficiary_name','service_id','transaction_id','user_id','payment','partiality','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service()
    {
        return $this->hasOne('App\Models\Service', 'id', 'service_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction', 'id', 'transaction_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value), 'UTF-8');
    }
}
