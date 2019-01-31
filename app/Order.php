<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'email', 'password','type','mobile','address',
    ];
    

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id', 'id');
    }

    public function shipped_by()
    {
        return $this->belongsTo('App\User', 'shipped_by', 'id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'order_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\OrderProducts', 'order_id', 'id');
    }

}
