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
            $table->boolean('is_penilai')->default(false);
            $table->string('password')->nullable();

            $table->unsignedBigInteger('id_bidang')->nullable();
            $table->unsignedBigInteger('id_atasan')->nullable();
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_approval_1')->nullable();
            $table->unsignedBigInteger('id_approval_2')->nullable();
            $table->unsignedBigInteger('id_cabang')->nullable();

            //foreign
            $table->foreign('id_bidang')->references('id')->on('m_bidang');
            $table->foreign('id_atasan')->references('id')->on('m_karyawan');
            $table->foreign('id_jabatan')->references('id')->on('m_jabatan');
            $table->foreign('id_approval_1')->references('id')->on('m_karyawan');
            $table->foreign('id_approval_2')->references('id')->on('m_karyawan');
            $table->foreign('id_cabang')->references('id')->on('m_cabang');
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
