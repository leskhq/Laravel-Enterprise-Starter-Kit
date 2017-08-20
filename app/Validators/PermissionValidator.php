<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PermissionValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'          => 'required|unique:permissions',
            'display_name'  => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'          => 'required|unique:permissions,name,',
            'display_name'  => 'required',
        ],
   ];
}
