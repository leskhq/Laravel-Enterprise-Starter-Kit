<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    /**
     * [$fillable description]
     * @var array
     */
    protected $fillable = ['product_id'];

    /**
     * one to one relation with product
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * one to many relation to Formula details
     */
    public function formulaDetails()
    {
        return $this->hasMany('App\Models\FormulaDetail');
    }
}
