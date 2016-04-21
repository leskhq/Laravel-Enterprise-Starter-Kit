<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'order_date',
        'transfer_date',
        'ship_date',
        'estimation_date',
        'transfer_via',
        'discount',
        'nominal',
        'shipping_fee',
        'packing_fee',
        'expedition',
        'resi',
        'description',
        'status'
    ];

    /**
     * @var timestamps
     */
    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function saleDetails()
    {
        return $this->hasMany('App\Models\SaleDetail');
    }

    public function getStatusDisplayName() {
        if ( $this->status == 1 ) {
            return "Baru";
        } elseif ( $this->status == 2 ) {
            return "Release";
        } elseif ( $this->status == 3 ) {
            return "Ready Hold";
        } elseif ( $this->status == 4 ) {
            return "Siap Kirim";
        } elseif ( $this->status == 5 ) {
            return "Kirim";
        } elseif ( $this->status == 6 ) {
            return "Pending";
        }
    }

    public function getStatusDisplayColour() {
        if ($this->status == 1) {
            return "info";
        } elseif ($this->status == 2) {
            return "danger";
        } elseif ($this->status == 3) {
            return "info";
        } elseif ($this->status == 4) {
            return "warning";
        } elseif ($this->status == 5) {
            return "success";
        } elseif ($this->status == 6) {
            return "warning";
        }
    }
}
