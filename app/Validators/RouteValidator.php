<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class RouteValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'          => 'required|unique:routes',
            'action_name'   => 'required',
            'method'        => 'required',
            'path'          => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'          => 'required|unique:routes,name,id',
            'action_name'   => 'required',
            'method'        => 'required',
            'path'          => 'required'
        ],
   ];
}
