<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutletSaleDaily extends Model
{
    /**
    * @var array
    */
    protected $fillable =
    [
        'outlet_laundry_id',
        'kilo_quantity',
        'piece_quantity',
        'total_kilo_cost',
        'total_piece_cost',
        'income',
        'description',
        'created_at'
    ];

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet', 'outlet_laundry_id');
    }
}
