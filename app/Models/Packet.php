<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    protected $fillable = ['name', 'price'];

    public $timestamps = false;

    public function partnerFee() {
    	return $this->hasMany('App\Models\PartnerFee');
    }
}

