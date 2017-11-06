<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Withdraw extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'withdraws';

    protected $fillable = ['user_id', 'cardholder', 'balance', 'bank_card', 'open_bank', 'is_handle'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
