<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\Owner;
use App\Models\TypeVehicle;
use App\Models\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'license_plate' => $faker->bothify('???-###'),
        'owner_id' => factory(Owner::class)->create()->id,
        'brand_id' => factory(Brand::class)->create()->id,
        'type_vehicle_id' => factory(TypeVehicle::class)->create()->id
    ];
});
