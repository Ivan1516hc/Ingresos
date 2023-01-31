<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PromotersTransaction
 *
 * @property $id
 * @property $promoter_id
 * @property $transaction_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Promoter $promoter
 * @property Transaction $transaction
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PromotersTransaction extends Model
{
    
    static $rules = [
		'promoter_id' => 'required',
		'transaction_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['promoter_id','transaction_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function promoter()
    {
        return $this->hasOne('App\Models\Promoter', 'id', 'promoter_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction', 'id', 'transaction_id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value), 'UTF-8');
    }
}
