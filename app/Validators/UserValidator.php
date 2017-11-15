<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'username'          => 'required|unique:users',
            'email'             => 'required|unique:users',
            'first_name'        => 'required',
            'last_name'         => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'username'          => 'required|unique:users,username,id',
            'email'             => 'required|unique:users,email,id',
            'first_name'        => 'required',
            'last_name'         => 'required',
        ],
   ];

    public function getCreateValidationRules()
    {
        return $this->rules[ValidatorInterface::RULE_CREATE];
    }

    public function getUpdateValidationRules()
    {
        return $this->rules[ValidatorInterface::RULE_UPDATE];
    }
}
