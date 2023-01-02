<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'drivers';
    // public $incrementing = false;

    protected $fillable = [
        'jenis_kendaraan',
        'nomor_polisi',
    ];

    // protected $hidden = [
    // ];
}
