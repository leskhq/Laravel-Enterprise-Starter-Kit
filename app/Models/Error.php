<?php namespace app\Models;

use Tylercd100\LERN\Models\ExceptionModel;
use App\User;

class Error extends ExceptionModel
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    /**
//     * @return string
//     */
//    public function getTraceAttribute()
//    {
//        return $this->Label;
//    }

}
