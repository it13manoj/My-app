<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        // 'user_first_name' => $faker->name,
        // 'email' => $faker->unique()->safeEmail,
        'user_first_name' => 'admin',
        'email' => 'admin@admin.com',
        'user_username'=>'admin'.str_random(10),
        'user_role'=>'Admin',
        'user_token'=>str_random(10),
        'user_status'=>1,
        'is_email_verified'=>1,
        'is_contact_verified'=>1,
        'blocked_by_admin'=>0,
        'is_deleted'=>0,
        'user_salary_confidential'=>0,
        'user_salary_negotiable'=>0,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
