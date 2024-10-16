<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class ShippingEmail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'email',
        'status',
        'error',
        'read',
        'shipping_id',
        'user_id'
    ];

    public function shipping()
    {
        return $this->belongsTo('App\Models\Shipping');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
