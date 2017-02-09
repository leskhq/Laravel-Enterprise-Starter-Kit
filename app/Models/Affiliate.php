<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $fillable = ['user_id', 'balance', 'click', 'link'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function storeCustomers() {
    	return $this->hasMany('App\Models\StoreCustomer', 'aff_id');
    }
}
