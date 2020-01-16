<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PageContent::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'description' => $faker->text,
        'keywords' => $faker->text,
        'h1' => $faker->text,
        'text' => $faker->text,
    ];
});
