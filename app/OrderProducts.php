<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    public function product_info()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
