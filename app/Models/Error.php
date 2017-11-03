<?php namespace app\Models;

use App\Models\User;
use Tylercd100\LERN\Models\ExceptionModel;

class Error extends ExceptionModel
{

    protected $table = 'lern_exceptions';
    protected $appends = array('flatdata');

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFlatdataAttribute()
    {
        $data = $this->data;
        $step1 = http_build_query($this->data, '', PHP_EOL);
        $step2 = urldecode($step1);
        return $step2;
    }

    public function scopeFreesearch($query, $value)
    {
        // search against multiple fields using OR
        return $query->where('class','like','%'.$value.'%')
            ->orWhere('file','like','%'.$value.'%')
            ->orWhere('code','like','%'.$value.'%')
            ->orWhere('status_code','like','%'.$value.'%')
            ->orWhere('line','like','%'.$value.'%')
            ->orWhere('message','like','%'.$value.'%')
            ->orWhere('trace','like','%'.$value.'%')
            ->orWhere('data','like','%'.$value.'%')
            ->orWhere('url','like','%'.$value.'%')
            ->orWhere('method','like','%'.$value.'%')
            ->orWhere('ip','like','%'.$value.'%')
            // Look into assigned roles
            ->orWhereHas('user', function ($q) use ($value) {
                $q->where('username','like','%'.$value.'%')
                    ->orWhere('first_name','like','%'.$value.'%')
                    ->orWhere('last_name','like','%'.$value.'%')
                    ->orWhere('email','like','%'.$value.'%');
            });

    }


}
