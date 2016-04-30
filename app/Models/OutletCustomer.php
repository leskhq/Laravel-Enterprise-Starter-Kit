<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutletCustomer extends Model
{
    /**
    * @var array
    */
    protected $fillable = ['name', 'outlet_laundry_id', 'email', 'phone', 'address'];

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet');
    }
}
