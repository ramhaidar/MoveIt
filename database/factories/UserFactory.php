<?php

namespace Database\Factories;

use App\Models\Driver;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create();
        $status = $faker->shuffle([0, 1, 0]);
        $phonearray = [
            strval($faker->randomNumber(9, true)),
            (strval($faker->randomNumber(9, true)) . strval($faker->randomNumber(1, true))),
            (strval($faker->randomNumber(9, true)) . strval($faker->randomNumber(2, true))),
        ];
        $phone = strval("08") . strval($faker->randomElement($phonearray));

        $username = str_replace('.', '', $faker->userName());
        while (strlen($username) < 6 || strlen($username) > 10) {
            $username = str_replace('.', '', $faker->userName());
        }

        if ($status[1] != 1) {
            return [
                'name' => $faker->name(),
                'is_admin' => $status[0],
                'is_driver' => $status[1],
                'is_customer' => $status[2],
                'username' => $username,
                'email' => $faker->email(),
                'password' => Hash::make($faker->password(6, 12)),
                'tanggal_lahir' => $faker->date('Y-m-d', '2004-12-30'),
                'nik' => strval($faker->numberBetween(3525011711086058, 3525999999999999)),
                'nomor_telepon' => $phone,
            ];
        } else {
            $theID = Driver::factory()->create()->id;
            return [
                'name' => $faker->name(),
                'is_admin' => $status[0],
                'is_driver' => $status[1],
                'is_customer' => $status[2],
                'username' => $faker->userName(),
                'email' => $faker->email(),
                'password' => Hash::make($faker->password(6, 12)),
                'tanggal_lahir' => $faker->date('Y-m-d', '2004-12-30'),
                'nik' => strval($faker->numberBetween(3525011711086058, 3525999999999999)),
                'nomor_telepon' => $phone,
                'driver_id' => $theID,
            ];
        }

    }
}
