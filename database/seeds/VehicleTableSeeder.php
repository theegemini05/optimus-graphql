<?php

use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        \App\User::all()->each(function ($user) use ($faker) {
            foreach (range(1, 5) as $i) {
                \App\Vehicle::create([
                    'user_id' => $user->id,
                    'registration_number'   => $faker->bothify('???-####'),
                    'year_of_manufacture' => $faker->numerify('####'),
                    'vehicle_type' => $faker->lexify('??????'),
                    'tonnage' => $faker->randomNumber(2, false),
                ]);
            }
        });
    }
}
