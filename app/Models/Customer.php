<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'fantasy_name',
        'email',
        'cpf',
        'cnpj',
        'phone',
        'slug',
        'type',
        'avatar',
        'user_id'
    ];

    public function accounts()
    {
        return $this->hasMany('App\Models\CustomerAccount');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
