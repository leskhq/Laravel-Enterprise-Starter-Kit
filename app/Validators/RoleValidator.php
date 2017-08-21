<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class RoleValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'          => 'required|unique:roles',
            'display_name'  => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'          => 'required|unique:roles,name,id,',
            'display_name'  => 'required',
        ],
   ];
}
