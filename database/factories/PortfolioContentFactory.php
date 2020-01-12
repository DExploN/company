<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PortfolioContent::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'description' => $faker->text,
        'text' => $faker->text,
    ];
});
