<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        foreach(range(1, 7) as $__) {
            DB::table('workshops')->insert([
                'address' => $faker->address,
                'title' => $faker->company,
                'contacts' => $faker->e164PhoneNumber
            ]);
        }

            foreach(range(1, 20) as $_) {
                DB::table('mechanics')->insert([
                    'name' => $faker->firstName,
                    'surname' => $faker->lastName,
                    'image_path' => '',
                    'workshop_id' => rand(1, 7),
                    'rating' => 0,
                    'rate_count' => 0,
                    'avrRating' => 0
                ]);
            }

            

            $services = ['Brake system repair', 'Cooling system repair', 'Engine oil and oil filter change', 'Diagnosis', 'Fuel system cleaning', 'Power steering fluid change', 'Suspension repair', 'Basic inspection', 'Tyre change', 'Alternator replacement', 'Glow plugs replacement', 'Electronic system repair', 'Front bumper painting'];

        foreach(range(1, 13) as $_) {
            DB::table('services')->insert([
                'service_title' => $services[rand(0, count($services) - 1)],
                'workshop_id' => rand(1, 7),
                'duration' => rand(1, 10),
                'price' => rand(50, 600),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1'),
            'role' => 10,
        ]);
    }
}
