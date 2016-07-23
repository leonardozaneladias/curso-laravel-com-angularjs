<?php
/**
 * Created by PhpStorm.
 * User: leonardozaneladias
 * Date: 22/07/16
 * Time: 21:28
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;


class ProjectValidator extends LaravelValidator
{

    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required|max:255',
        'description' => '',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required'
    ];

}