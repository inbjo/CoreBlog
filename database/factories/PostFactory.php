<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {

    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'title' => $faker->sentence,
        'slug' => $faker->unique()->slug,
        'keyword' => $faker->words(5, true),
        'description' => $faker->paragraph,
        'content' => $faker->text(1024),
        'cover' => '/images/hello.jpg',
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
