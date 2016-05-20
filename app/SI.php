<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SI extends Model
{
       
       protected $primaryKey = 'si_profile_id ';
	   public $timestamps = false;
	   protected $table = 'si_profile';
}
