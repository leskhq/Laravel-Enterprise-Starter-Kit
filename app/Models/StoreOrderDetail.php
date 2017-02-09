<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreOrderDetail extends Model
{
    protected $fillable = ['order_id', 'product_id', 'price', 'description'];

    public $timestamps = false;

    public function storeOrder() {
    	return $this->belongsTo('App\Models\StoreOrder');
    }
}
