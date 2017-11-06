<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Model\User::class, function (Faker\Generator $faker) {
    static $openId = 'o6_bmjrPTlm6_2sgVt7hMZOPfL2M';

    return [
        'open_id'   =>  $openId,
        'phone'     =>  $faker->phoneNumber,
        'bank_card' =>  $faker->bankAccountNumber,
        'address'   =>  $faker->address,
        'balance'   =>  $faker->randomFloat(null, 0, 1000),
        'score'     =>  $faker->numberBetween(0,200),
        'level'     =>  $faker->randomElement([1, 2, 3, 4])
    ];
});

$factory->define(App\Model\Category::class, function(Faker\Generator $faker) {
    return [
        'parent_id' => 0,
        'name'      => $faker->userName,
        'description' => $faker->text(100)
    ];
});

$factory->define(App\Model\Package::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'price' => $faker->numberBetween(0,300),
        'rate'  => $faker->randomFloat(null, 0, 1),
        'fruit' => $faker->randomFloat(null, 0, 100)
    ];
});

$factory->define(App\Model\Subscribe::class, function(Faker\Generator $faker) {
    return [
        'name'  =>  $faker->userName,
        'total' =>  $faker->numberBetween(0,200),
        'unit'  =>  $faker->randomFloat(null, 0, 20)
    ];
});