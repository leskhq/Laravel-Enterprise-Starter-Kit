<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
    * @var array
    */
    protected $fillable = ['name', 'category', 'status', 'contact', 'address', 'description'];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function purchaseOrderDetails()
    {
        return $this->belongsToMany('App\Models\PurchaseOrder');
    }

    public function getCategoryDisplayName() {
        if ($this->category == 1) {
            return "Chemical";
        } elseif ($this->category == 2) {
            return "Perlengkapan";
        } elseif ($this->category == 3) {
            return "Peralatan";
        } elseif ($this->category == 4) {
            return "Bibit Parfum";
        } elseif ($this->category == 5) {
            return "Lain - lain";
        }
    }
}
