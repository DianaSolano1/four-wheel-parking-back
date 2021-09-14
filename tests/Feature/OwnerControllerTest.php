<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class OwnerControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testNonExistingOwnerIdNumber()
    {

        $this->json('get', '/api/owner/nonexistingnumber')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([]);
    }
}
