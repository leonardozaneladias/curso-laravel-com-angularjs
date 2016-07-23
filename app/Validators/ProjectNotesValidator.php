<?php

namespace CodeProject\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectNotesValidator extends LaravelValidator
{

    protected $rules = [
        'note' => 'required'
    ];
}
