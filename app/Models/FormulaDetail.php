<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormulaDetail extends Model
{
    protected $fillable = ['formula_id', 'material_id', 'quantity'];

    /**
    * @var timestamps
    */
    public $timestamps = false;

    public function formula()
    {
        return $this->belongsTo('App\Models\Formula');
    }

    public function material()
    {
        return $this->belongsTo('App\Models\Material');
    }
}
