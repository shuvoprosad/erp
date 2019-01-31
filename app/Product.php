<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'units_in_stock',
    ];

    public function product_type()
    {
        return $this->belongsTo('App\ProductType', 'type', 'id');
    }
}
