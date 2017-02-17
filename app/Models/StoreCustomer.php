<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreCustomer extends Model
{
    protected $fillable = ['user_id', 'aff_id', 'address', 'ship_address'];

    public $timestamps = false;

    public function name() {
        return $this->user->first_name .' '. $this->user->last_name;
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function affiliate() {
    	return $this->belongsTo('App\Models\Affiliate', 'aff_id');
    }

    public function orders() {
    	return $this->hasMany('App\Models\StoreOrder');
    }
}
