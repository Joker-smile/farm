<?php

namespace App\Entities;

use App\Presenters\SubscribePresenter;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Builder;

class Subscribe extends Model
{
    protected $table = 'subscribes';

    use PresentableTrait;

    protected $presenter = SubscribePresenter::class;

    protected $fillable = ['name', 'user_id', 'count', 'unit', 'total', 'origin', 'augment', 'gross', 'status', 'expired_at', 'subscribe_id', 'inviter_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inviter(){
        return $this->belongsTo(User::class, 'inviter_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('status', function(Builder $builder) {
            $builder->where('status', '!=', 'unpaid');
        });
    }
}
