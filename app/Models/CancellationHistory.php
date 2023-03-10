<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CancellationHistory
 *
 * @property $id
 * @property $transaction_id
 * @property $user_id
 * @property $authorized_user_id
 * @property $reason
 * @property $created_at
 * @property $updated_at
 *
 * @property Transaction $transaction
 * @property User $user
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
    protected $fillable = ['transaction_id','user_id','authorized_user_id','reason','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction', 'invoice', 'transaction_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'authorized_user_id');
    }
    
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        if (is_string($value))
            $this->attributes[$key] = trim(mb_strtoupper($value));
    }
}
