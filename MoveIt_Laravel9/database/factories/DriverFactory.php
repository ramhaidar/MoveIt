<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create();
        $A = $faker->countryCode();
        $B = $faker->randomNumber(4, true);
        $C = $faker->countryISOAlpha3();
        $NOPOL = "$A $B $C";
        return [
            'jenis_kendaraan' => $faker->randomElement(['Motor', 'Mobil', 'Van', 'PickUp', 'Engkel', 'CDD']),
            'nomor_polisi' => $NOPOL,
        ];
    }
}
