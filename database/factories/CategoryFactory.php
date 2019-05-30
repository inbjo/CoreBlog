<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    // 随机取一个月以内的时间
    $updated_at = $faker->dateTimeThisMonth();
    // 传参为生成最大时间不超过，创建时间永远比更改时间要早
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'name' => $faker->name,
        'slug' => $faker->unique()->slug,
        'post_count' => 0,
        'sort' => 0,
        'description' => $faker->sentence(),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];

});
