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
        Schema::create('m_karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_pegawai');

            $table->unsignedBigInteger('id_bidang');
            $table->unsignedBigInteger('id_atasan');
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_approval_1');
            $table->unsignedBigInteger('id_approval_2');

            //foreign
            $table->foreign('id_bidang')->references('id')->on('m_bidang');
            $table->foreign('id_atasan')->references('id')->on('m_users');
            $table->foreign('id_jabatan')->references('id')->on('m_jabatan');
            $table->foreign('id_approval_1')->references('id')->on('m_users');
            $table->foreign('id_approval_2')->references('id')->on('m_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_karyawan');
    }
};
