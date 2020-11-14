<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserVehicleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_user_vehicle_create()
    {
        $response = $this->postJson('/api/vehicles', [
            'name'              => 'Cesar',
            'dni'               => '098765432',
            'vehicle_brand_id'  => 2,
            'license'           => 'LRP440',
            'type'              => 'Cars',
        ]);

        $response
            ->assertStatus(201);
    }
}
