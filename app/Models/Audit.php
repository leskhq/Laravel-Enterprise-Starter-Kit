<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'category', 'message', 'data', 'action'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
