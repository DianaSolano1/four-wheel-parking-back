<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TypeVehicle;
use Faker\Generator as Faker;

$factory->define(TypeVehicle::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word()
    ];
});
