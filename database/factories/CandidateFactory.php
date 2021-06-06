<?php

use Faker\Generator as Faker;

$factory->define(\GriffonTech\Candidate\Models\Candidate::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $faker->password(),
    ];
});
