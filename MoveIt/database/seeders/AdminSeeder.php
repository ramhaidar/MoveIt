<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Haidaruddin Muhammad Ramdhan',
            'username' => 'haidar',
            'email' => 'haidaruddinmuhammadr@gmail.com',
            'password' => Hash::make('anakhalal'),
            'tanggal_lahir' => '2001/05/24',
            'nik' => '3525016501830002',
            'nomor_telepon' => '081238777306',
            'is_admin' => '1',
        ]);

        User::create([
            'name' => 'Radli Maulana Arief',
            'username' => 'radli',
            'email' => 'radlimaulanaf@gmail.com',
            'password' => Hash::make('anakhalal'),
            'tanggal_lahir' => '2000/04/20',
            'nik' => '3525016501830001',
            'nomor_telepon' => '081282763509',
            'is_admin' => '1',
        ]);

        User::create([
            'name' => 'Argya Mauluvy Senjaya',
            'username' => 'argya',
            'email' => 'argyamauluvy@gmail.com',
            'password' => Hash::make('anakhalal'),
            'tanggal_lahir' => '2002/11/03',
            'nik' => '3525016501830003',
            'nomor_telepon' => '0895375454695',
            'is_admin' => '1',
        ]);

        User::create([
            'name' => 'Muhammad Farisal Imtiyaz',
            'username' => 'farisal',
            'email' => 'muhammadfarisali@gmail.com',
            'password' => Hash::make('anakhalal'),
            'tanggal_lahir' => '2001/10/01',
            'nik' => '3525016501830004',
            'nomor_telepon' => '081324475884',
            'is_admin' => '1',
        ]);
    }
}
