<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'address', 'type', 'status', 'laundry_address', 'laundry_name'];

    public function customerFollowups() {
        return $this->hasMany('App\Models\CustomerFollowup');
    }
}
