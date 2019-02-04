<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentNumbers extends Model
{
    protected $fillable = [
        'mobile', 'payment_method_id'
    ];
    public function paymentmethod()
    {
        return $this->belongsTo('App\PaymentMethod', 'payment_method_id', 'id');
    }
}
