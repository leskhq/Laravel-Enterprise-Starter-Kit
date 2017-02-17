<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorePartner extends Model
{
    public function partner() {
        return $this->hasOne('App\Models\Partner');
    }

    public function storePartnerProducts() {
        return $this->hasMany('App\Models\StorePartnerProduct');
    }
}
