<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['sale_id', 'product_id', 'price', 'price', 'quantity', 'total', 'weight', 'description'];

    /**
     * @var timestamps
     */
    public $timestamps = false;

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
