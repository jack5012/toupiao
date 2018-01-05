<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class VoteItemValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
