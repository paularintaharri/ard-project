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

$factory->define(App\Ticket::class, function (Faker $faker) {


    return [
        'lat' => $faker->latitude,
        'lon' => $faker->longitude,
        'street_address' => $faker->address,
        'postal_code' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});