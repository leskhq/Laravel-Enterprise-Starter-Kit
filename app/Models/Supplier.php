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

  public function getCategoryDisplayName($category_id) {
    if ($category_id == 1) {
        return "Chemical";
    } elseif ($category_id == 2) {
        return "Perlengkapan";
    } elseif ($category_id == 3) {
        return "Peralatan";
    } elseif ($category_id == 4) {
        return "Bibit Parfum";
    } elseif ($category_id == 5) {
        return "Lain - lain";
    }
  }
}
