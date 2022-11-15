<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id              ('driver_id');
            // $table->string          ('nama');
            // $table->string          ('nik')->unique();
            // $table->string          ('email')->unique();
            // $table->date            ('tanggal_lahir');
            $table->string          ('jenis_kendaraan');
            $table->string          ('nomor_polisi')->unique();
            // $table->rememberToken   ();
            $table->timestamps      ();

            $table->foreign('driver_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
};
