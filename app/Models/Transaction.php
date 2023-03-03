<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 *
 * @property $id
 * @property $invoice
 * @property $bill
 * @property $total
 * @property $beneficiary_id
 * @property $beneficiary_name
 * @property $location_id
 * @property $user_id
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property CancellationHistory[] $cancellationHistories
 * @property Location $location
 * @property LocationsTransaction[] $locationsTransactions
 * @property PromotersTransaction[] $promotersTransactions
 * @property ReprintHistory[] $reprintHistories
 * @property ServicesTransaction[] $servicesTransactions
 * @property TherapistsTransaction[] $therapistsTransactions
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Transaction extends Model
{
    
    static $rules = [
		'beneficiary_id' => 'required',
		'beneficiary_name' => 'required',
        'serviciosAgregados' => 'required'
    ];

    protected $casts=[
        'created_at'    => 'date:d-m-Y',
        'update_at'     => 'date:d-m-Y'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','invoice','bill','total','beneficiary_id','beneficiary_name','location_id','user_id','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cancellationHistories()
    {
        return $this->hasMany('App\Models\CancellationHistory', 'transaction_id', 'invoice');
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
    public function locationsTransactions()
    {
        return $this->hasMany('App\Models\LocationsTransaction', 'transaction_id', 'invoice');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promotersTransactions()
    {
        return $this->hasMany('App\Models\PromotersTransaction', 'transaction_id', 'invoice');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reprintHistories()
    {
        return $this->hasMany('App\Models\ReprintHistory', 'transaction_id', 'invoice');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicesTransactions()
    {
        return $this->hasMany('App\Models\ServicesTransaction', 'transaction_id', 'invoice');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function therapistsTransactions()
    {
        return $this->hasMany('App\Models\TherapistsTransaction', 'transaction_id', 'invoice');
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
            $this->attributes[$key] = trim(mb_strtoupper($value));
    }
}
