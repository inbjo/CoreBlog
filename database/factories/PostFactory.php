<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    // 随机取一个月以内的时间
    $updated_at = $faker->dateTimeThisMonth();
    // 传参为生成最大时间不超过，创建时间永远比更改时间要早
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'title'=>$faker->sentence,
        'keyword'=>$faker->words(5, true),
        'description'=>$faker->paragraph,
        'slug'=>$faker->slug,
        'content'=>$faker->text(1024),
        'comment_count'=>0,
        'cover'=>$faker->imageUrl(1400, 800),
        'view_count'=>rand(1000, 9999),
        'favorite_count'=>rand(1000, 9999),
        'published'=>1,
        'publish_time'=>0,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
