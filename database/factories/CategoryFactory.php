<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {

    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'name' => $faker->name,
        'slug' => $faker->unique()->slug,
        'sort' => 0,
        'description' => $faker->sentence(),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
