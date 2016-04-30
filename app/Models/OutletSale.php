<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutletSale extends Model
{
    /**
    * @var array
    */
    protected $fillable =
    [
        'outlet_laundry_id',
        'kilo_quantity',
        'kilo_total',
        'piece_quantity',
        'piece_total',
        'description'
    ];

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet', 'outlet_laundry_id');
    }
}
