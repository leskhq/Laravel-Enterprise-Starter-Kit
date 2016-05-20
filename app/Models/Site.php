<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{ 
    protected $fillable = ['address', 'city', 'state', 'user_id', 'area'];
    
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    
}
