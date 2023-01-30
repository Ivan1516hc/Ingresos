<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CancellationHistory
 *
 * @property $id
 * @property $transaction_id
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Transaction $transaction
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CancellationHistory extends Model
{
    
    static $rules = [
		'transaction_id' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['transaction_id','user_id'];


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
    

}
