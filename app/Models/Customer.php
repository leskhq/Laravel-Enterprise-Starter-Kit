<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'address', 'type', 'status', 'laundry_address', 'laundry_name', 'created_at'];

    public function customerFollowups()
    {
        return $this->hasMany('App\Models\CustomerFollowup');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale');
    }

    public function getCustomerTypeDisplayName()
    {
        if ( $this->type == 1 ) {
            return 'Mitra BO Lisensi';
        } elseif ( $this->type == 2 ) {
            return 'Agen Resmi';
        } elseif ( $this->type == 3 ) {
            return 'Agen Lepas';
        } elseif ( $this->type == 4 ) {
            return 'Customer Biasa';
        } elseif ( $this->type == 5 ) {
            return 'Distributor';
        } elseif ( $this->type == 6 ) {
            return 'Mitra BO Murni';
        } elseif ( $this->type == 7 ) {
            return 'Investor';
        }
    }
}
