<?php

namespace App\Entities;

use App\Presenters\OrderPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * @property mixed product
 */
class Order extends Model
{
    const COMMON = 'common';
    const GIFT = 'gift';
    const TREE = 'tree';
    const FRUIT = 'fruit';

    use PresentableTrait;

    protected $presenter = OrderPresenter::class;

    protected $table = 'orders';

    protected $fillable = ['order_number', 'user_id', 'total', 'address_id', 'status', 'shipping_carrier', 'shipping_number', 'type'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('status', function(Builder $builder) {
            $builder->where('status', '!=', 'unpaid');
        });
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
