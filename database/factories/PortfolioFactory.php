<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Portfolio::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
        'description' => $faker->text,
        'text' => $faker->text,
        'android_link' => $faker->url,
        'apple_link' => $faker->url,
    ];
});
