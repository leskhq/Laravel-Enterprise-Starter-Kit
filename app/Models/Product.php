<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  /**
   * @var array
   */
  protected $fillable = [
    'name',
    'category',
    'hpp',
    'price',
    'agenresmi_price',
    'agenlepas_price',
    'distributor_price',
    'weight','perfume_id',
    'supplier_id',
    'description'
  ];

  /**
   * @var timestamps
   */
  public $timestamps = false;

  public function perfume() {
    return $this->belongsTo('App\Models\Perfume');
  }

  public function supplier() {
    return $this->belongsTo('App\Models\Supplier');
  }
}
