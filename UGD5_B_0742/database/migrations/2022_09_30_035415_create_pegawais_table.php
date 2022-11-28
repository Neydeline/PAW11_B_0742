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
        Schema::dropIfExists('pegawais');
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_induk_pegawai');
            $table->string('nama_pegawai');
            $table->unsignedBigInteger('id_departemen');
            $table->string('email');
            $table->integer('telepon');
            $table->boolean('gender');
            $table->integer('gaji_pokok');
            $table->boolean('status');
            $table->timestamps();
            
            $table->foreign('id_departemen')->references('id')->on('departemens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
};
