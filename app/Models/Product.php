<?php

namespace App\Models;

use App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
    * @var array
    */
    protected $fillable = [
        'name',
        'category_id',
        'hpp',
        'price',
        'agenresmi_price',
        'agenlepas_price',
        'stock',
        'weight',
        'perfume_id',
        'supplier_id',
        'description',
        'published'
    ];

    /**
    * @var timestamps
    */
    public $timestamps = false;

    public function categories() {
        return $this->belongsTo('App\Models\Category');
    }

    public function perfume()
    {
        return $this->belongsTo('App\Models\Perfume');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function saleDetails()
    {
        return $this->hasMany('App\Models\SaleDetail');
    }

    public function formula()
    {
        return $this->belongsTo('App\Models\Formula');
    }

    public function storePartnerProducts() {
        return $this->hasMany('App\Models\StorePartnerProduct');
    }

    public function scopeCategorized($query, Category $category=null) {
        if ( is_null($category) ) return $query->with('categories');
        
        $categoryIds = $category->getDescendantsAndSelf()->lists('id');

        return $query->with('categories')
            ->where('category_id', $categoryIds);

    }
}
