<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBrandResponseIsWellFormed()
    {
        $response = $this->getJson('/api/brand/vehicles');

        $response->assertJsonStructure([
            'data' => []
        ]);

        $this->assertIsArray($response->json('data')['data']);
    }


    public function testNonExistingBrandName()
    {
        $response = $this->getJson('/api/brand/vehicles?name=NonExistingBrand');

        $data = $response->json('data');

        $this->assertTrue($response->json('success'));
        $this->assertIsArray($data['data']);
        $this->assertEmpty($data['data']);
    }
}
