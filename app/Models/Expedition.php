<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expedition extends Model
{
  /**
   * @var array
   */
  protected $fillable = ['name', 'contact', 'description'];
}
