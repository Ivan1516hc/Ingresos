<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServicesTransaction
 *
 * @property $id
 * @property $transaction_id
 * @property $service_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Service $service
 * @property Transaction $transaction
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ServicesTransaction extends Model
{
    
    static $rules = [
		'transaction_id' => 'required',
		'service_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['transaction_id','service_id'];


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
        return $this->hasOne('App\Models\Transaction', 'invoice', 'transaction_id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value));
    }
}
