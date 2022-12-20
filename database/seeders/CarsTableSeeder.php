<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drivers = Driver:: all();

        $cars = ['Lada','Opel','Skoda','Nissan','BMW'];

        foreach ($drivers as $driver) {

            $class = rand(0,4);

            DB::table('cars')->insert([
                'model' => $cars[$class],
                'class' => $class+1,
                'driver_id' => $driver['id'],
            ]);
        }
    }
}
