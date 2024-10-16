<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'domain',
        'slug',
        'customer_id',
        'user_id'
    ];

    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function shipping()
    {
        return $this->hasMany('App\Models\Shipping');
    }

}
