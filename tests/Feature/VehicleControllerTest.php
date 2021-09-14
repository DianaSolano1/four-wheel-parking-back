<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Owner;
use App\Models\TypeVehicle;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNonExistingLicensePlace()
    {
        $response = $this->getJson('/vehicle/NonExistentPlate');

        $response->assertJson([]);
    }


    public function testExistingLicensePlate()
    {
        $license_plate = 'XYZ123';

        $vehicle = factory(Vehicle::class)->create([
            'license_plate' => $license_plate
        ]);


        $response = $this->getJson('\/vehicle\/' . $license_plate);

        $this->assertNotEmpty($response->json());

        $vehicle->delete();
    }

    public function testCanCreateVehicle()
    {

        $brand = factory(Brand::class)->create();
        $owner = factory(Owner::class)->create();
        $type = factory(TypeVehicle::class)->create();

        $response = $this->postJson('/api/vehicle', [
            'license_plate' => 'ASD123',
            'brand' => $brand->id,
            'owner' => [
                'id' => $owner->id,
            ],
            'type_vehicle' => $type->id
        ]);

        $response->assertJson([
            'success' => TRUE
        ]);
    }

    public function testCantCreateDuplicateLicensePlate()
    {
        $brand = factory(Brand::class)->create();
        $owner = factory(Owner::class)->create();
        $type = factory(TypeVehicle::class)->create();

        factory(Vehicle::class)->create([
            'license_plate' => 'ASD123'
        ]);

        $response = $this->postJson('/api/vehicle', [
            'license_plate' => 'ASD123',
            'brand' => $brand->id,
            'owner' => [
                'id' => $owner->id
            ],
            'type_vehicle' => $type->id
        ]);

        $response->dump();

        $response->assertJsonPath('errors.license_plate.0', 'The license plate has already been taken.');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
