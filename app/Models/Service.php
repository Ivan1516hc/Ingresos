<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Service
 *
 * @property $id
 * @property $name
 * @property $cost
 * @property $type_income
 * @property $code_income
 * @property $not_binding
 * @property $id_gu
 * @property $partial
 * @property $unit
 * @property $leadership
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property GroupsService[] $groupsServices
 * @property PartialPayment[] $partialPayments
 * @property ServicesTransaction[] $servicesTransactions
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Service extends Model
{
    use SoftDeletes;

    static $rules = [
		'name' => 'required',
		'cost' => 'required',
		'type_income' => 'required',
		'code_income' => 'required',
		'not_binding' => 'required',
		'id_gu' => 'required',
		'partial' => 'required',
		'unit' => 'required',
		'leadership' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','cost','type_income','code_income','not_binding','id_gu','partial','unit','leadership'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupsServices()
    {
        return $this->hasMany('App\Models\GroupsService', 'service_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partialPayments()
    {
        return $this->hasMany('App\Models\PartialPayment', 'service_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicesTransactions()
    {
        return $this->hasMany('App\Models\ServicesTransaction', 'service_id', 'id');
    }
    

}
