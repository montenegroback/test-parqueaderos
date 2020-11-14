<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleBrandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function test_it_load_list_vehicle_brands()
    {
        $response = $this->get('/api/vehicles/brands');
        $response->assertStatus(200);
    }
}
