<?php

namespace Database\Seeders;

use App\Models\VehicleBrand;
use Illuminate\Database\Seeder;

class VehicleBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = ['BMW', 'Mercedes-Benz', 'Audi', 'Lexus', 'Renault', 'Ford', 'Opel', 'Seat'];

        foreach($vehicles as $vehicle) {
            VehicleBrand::create([
                'name'  => $vehicle
            ]);
        }
    }
}
