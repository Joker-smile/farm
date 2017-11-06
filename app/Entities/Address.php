<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Address extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'address';

    protected $fillable = ['user_id', 'address', 'phone', 'receiver', 'is_default'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
