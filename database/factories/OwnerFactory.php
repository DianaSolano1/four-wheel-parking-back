<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Owner;
use Faker\Generator as Faker;

$factory->define(Owner::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'document_id' => $faker->numerify('##########')
    ];
});
