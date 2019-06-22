<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {

    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);
    $email = $faker->unique()->safeEmail;

    return [
        'name' => $faker->unique()->userName,
        'avatar' => generateAvatar($email),
        'email' => $email,
        'mobile' => $faker->e164PhoneNumber,
        'bio' => $faker->sentence,
        'password' => bcrypt('secret'),
        'email_verified_at' => Carbon::now()->toDateTimeString(),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
