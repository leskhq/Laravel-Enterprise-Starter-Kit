<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerFollowup extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'content', 'created_at'];

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }
}
