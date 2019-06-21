<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'name' => $faker->name,
        'url' => $faker->url,
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
