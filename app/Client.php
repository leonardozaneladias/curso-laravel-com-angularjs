<?php

namespace CodeProject;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'resposible',
        'email',
        'phone',
        'address',
        'obs'
    ];
}
