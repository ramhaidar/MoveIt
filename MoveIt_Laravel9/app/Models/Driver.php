<?php

namespace App\Models;

use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
