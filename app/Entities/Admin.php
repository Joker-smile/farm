<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements Transformable
{
    use TransformableTrait;

    protected $table = 'admins';

    protected $fillable = ['nickname', 'username', 'password'];

}
