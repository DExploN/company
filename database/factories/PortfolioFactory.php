<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Portfolio::class, function (Faker $faker) {
    return [
        'android_link' => $faker->url,
        'apple_link' => $faker->url,
        'year' => random_int(2010, 2019),
    ];
});
