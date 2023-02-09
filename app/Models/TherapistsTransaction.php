<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TherapistsTransaction
 *
 * @property $id
 * @property $therapist_id
 * @property $transaction_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Therapist $therapist
 * @property Transaction $transaction
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TherapistsTransaction extends Model
{
    
    static $rules = [
		'therapist_id' => 'required',
		'transaction_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['therapist_id','transaction_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function therapist()
    {
        return $this->hasOne('App\Models\Therapist', 'id', 'therapist_id');
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
