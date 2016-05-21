<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['supplier_id', 'description', 'total'];

    public function purchaseOrderDetails()
    {
        return $this->hasMany('App\Models\PurchaseOrderDetail');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
}
