<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Info extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'twitter', 'facebook', 'instagram', 'youtube', 'whatsapp', 'linkedin', 'email1', 'email2', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'info';
}
