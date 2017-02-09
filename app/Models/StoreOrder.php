<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    protected $fillable = ['store_customer_id', 'address', 'phone', 'total'];

    public function storeCustomer() {
    	return $this->belongsTo('App\Models\StoreCustomer');
    }

    public function storeOrderDetails() {
    	return $this->hasMany('App\StoreOrderDetail');
    }
}
