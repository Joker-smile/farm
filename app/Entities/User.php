<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Transformable
{
    use TransformableTrait;

    protected $table = 'users';

    protected $fillable = ['open_id', 'phone', 'balance', 'score', 'harvests', 'nickname', 'avatar'];

    public function subscribes(){
        return $this->hasMany(Subscribe::class);
    }

    public function withdraws(){
        return $this->hasMany(Withdraw::class);
    }

    public function address(){
        return $this->hasMany(Address::class)->orderBy('id', 'desc');
    }
    public function orders(){
            return $this->hasMany(Order::class)->orderBy('id', 'desc');
    }
}
