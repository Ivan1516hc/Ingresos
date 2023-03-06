<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PartialPaymentsTransaction
 *
 * @property $id
 * @property $partial_payment_id
 * @property $transaction_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property PartialPayment $partialPayment
 * @property Transaction $transaction
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PartialPaymentsTransaction extends Model
{
    use SoftDeletes;

    static $rules = [
		'partial_payment_id' => 'required',
		'transaction_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['partial_payment_id','transaction_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function partialPayment()
    {
        return $this->hasOne('App\Models\PartialPayment', 'id', 'partial_payment_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction', 'invoice', 'transaction_id');
    }
    

}
