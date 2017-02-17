<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorePartnerProduct extends Model
{
    public function storeProducts() {
        return $this->belongsToMany('App\Models\StoreProduct');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}
