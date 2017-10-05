<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Ticket::class, function (Faker $faker) {


    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'lat' => $faker->latitude,
        'lon' => $faker->longitude,
        'street_address' => $faker->address,
        'postal_code' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});