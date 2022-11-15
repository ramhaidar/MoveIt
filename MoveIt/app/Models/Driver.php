<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'driver_id';
    protected $table = 'drivers';

    // TODO: isi sama kolom yg ada di tabel drivers
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'nomor_polisi',
        'jenis_kendaraan',
        'is_admin',
        'is_driver',
        'is_customer',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'is_admin',
        'is_driver',
        'is_customer',
    ];
}
