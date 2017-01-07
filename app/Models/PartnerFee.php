<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerFee extends Model
{
	protected $table = 'partner_fee';

    public $timestamps = false;

    protected $fillable = [
        'partner_id',
        'packet_id',
        'first_payment',
        'second_payment',
        'commitment_fee',
        'first_pay',
        'settled',
        'addition',
        'description'
    ];

    public function partner() {
        return $this->belongsTo('App\Models\Partner');
    }

    public function packet() {
    	return $this->belongsTo('App\Models\Packet');
    }
}

