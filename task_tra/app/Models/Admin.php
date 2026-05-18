<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [

        'first_name',
        'last_name',
        'email',
        'phone',
        'state',
        'time',
        'image',
        'password',

    ];

    protected $hidden = [

        'password',
        'remember_token',

    ];
}