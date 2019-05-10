<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PostTag::class, function (Faker $faker) {
    // 随机取一个月以内的时间
    $time = $faker->dateTimeThisMonth();

    return [
        'created_at' => $time,
        'updated_at' => $time,
    ];
});
