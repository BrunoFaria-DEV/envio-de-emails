<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

        /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'title',
        'status',
        'shipping_type',
        'shipping_date',
        'shipping_code',
        'customer_account_id',
        'user_id'
    ];

    protected $fillable = [
        'title',
        'html',
        'status',
        'shipping_type',
        'shipping_date',
        'shipping_code',
        'customer_account_id',
        'user_id'
    ];

    public function customerAccount()
    {
        return $this->belongsTo('App\Models\CustomerAccount');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function shippingEmails()
    {
        return $this->hasMany('App\Models\ShippingEmail');
    }

    public function shippingImages()
    {
        return $this->hasMany('App\Models\ShippingImage');
    }
}
