<?php

namespace App\Providers;

use App\Repositories\AddressRepository;
use App\Repositories\AddressRepositoryEloquent;
use App\Repositories\AdminRepository;
use App\Repositories\AdminRepositoryEloquent;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderItemRepositoryEloquent;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryEloquent;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryEloquent;
use App\Repositories\SubscribeRepository;
use App\Repositories\SubscribeRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\WithdrawRepository;
use App\Repositories\WithdrawRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $repositories = [
        AddressRepository::class    =>  AddressRepositoryEloquent::class,
        AdminRepository::class      =>  AdminRepositoryEloquent::class,
        CategoryRepository::class   =>  CategoryRepositoryEloquent::class,
        OrderItemRepository::class  =>  OrderItemRepositoryEloquent::class,
        OrderRepository::class      =>  OrderRepositoryEloquent::class,
        ProductRepository::class    =>  ProductRepositoryEloquent::class,
        SubscribeRepository::class  =>  SubscribeRepositoryEloquent::class,
        UserRepository::class       =>  UserRepositoryEloquent::class,
        WithdrawRepository::class   =>  WithdrawRepositoryEloquent::class
        
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $key => $repository){
            $this->app->singleton($key, $repository);
        }
    }
}
