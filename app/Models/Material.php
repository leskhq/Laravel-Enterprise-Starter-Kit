<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /**
    * @var array
    */
    protected $fillable = ['name', 'stock', 'min_stock', 'price'];

    /**
    * @var timestamps
    */
    public $timestamps = false;

    /**
     * one to many relation between material and formula details
     * @return [type] [description]
     */
    public function formulaDetails()
    {
        return $this->hasMany('App\Models\FormulaDetail');
    }

    public function purchaseOrderDetails()
    {
        return $this->belongsToMany('App\Models\PurchaseOrderDetail');
    }
}
