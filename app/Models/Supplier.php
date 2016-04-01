<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  /**
   * @var array
   */
  protected $fillable = ['name', 'category', 'status', 'contact', 'address', 'description'];

  public function products() {
    return $this->hasMany('App\Models\Product');
  }
}
