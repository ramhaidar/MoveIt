<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'nomor_telepon' => '081234567891',
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
            'nomor_telepon' => '081234567892',
            'is_driver' => '1',
            'driver_id' => $theID,
        ]);

        User::factory()->count(300)->create();
    }
}
