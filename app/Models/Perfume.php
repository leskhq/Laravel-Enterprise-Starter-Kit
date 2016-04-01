<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
  /**
   * @var array
   */
  protected $fillable = [];

  /**
   * @var timestamps
   */
  public $timestamps = false;

  public function products() {
    return $this->hasMany('App\Models\Product');
  }
}
