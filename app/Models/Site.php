<?php
namespace App\Models;

use Kodeine\Metable\Metable;
use Illuminate\Database\Eloquent\Model;

 
class Site extends Model
{ 
	use Metable;
	
    protected $fillable = ['name', 'address', 'city', 'state', 'user_id', 'area', 'zip_code'];
   
    protected $metaTable = 'sites_meta';
    
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    
}
