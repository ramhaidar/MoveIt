<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Driver;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        User::create([
            'name' => 'Virman Pradana',
            'username' => 'customer',
            'email' => 'virmanpradana@gmail.com',
            'password' => Hash::make('123456'),
            'tanggal_lahir' => '1999/03/23',
            'nik' => strval($faker->numberBetween(3525011711086058, 3525999999999999)),
            'is_customer' => '1',
        ]);

        $theID = Driver::factory()->create()->id;
        User::create([
            'name' => 'Aisyah Oktaviani',
            'username' => 'driver',
            'email' => 'aisyahoktaviani@gmail.com',
            'password' => Hash::make('123456'),
            'tanggal_lahir' => '2001/11/03',
            'nik' => strval($faker->numberBetween(3525011711086058, 3525999999999999)),
            'is_driver' => '1',
            'driver_id' => $theID,
        ]);

        User::factory()->count(100)->create();
    }
}
