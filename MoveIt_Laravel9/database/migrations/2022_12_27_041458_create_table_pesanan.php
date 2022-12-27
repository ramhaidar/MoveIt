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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id              ('id');
            $table->string          ('alamat_pickup');
            $table->string          ('alamat_tujuan');
            $table->smallInteger    ('berat');
            $table->string          ('deskripsi');
            $table->float           ('jarak');
            $table->bigInteger      ('tarif');
            $table->date            ('tanggal');
            $table->time            ('jam');
            $table->boolean         ('is_completed');
            $table->unsignedBigInteger  ('customer_id')->nullable();
            $table->foreign             ('customer_id')->references('id')->on('users');
            $table->timestamps      ();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });

        Schema::dropIfExists('pesanan');
    }
};
