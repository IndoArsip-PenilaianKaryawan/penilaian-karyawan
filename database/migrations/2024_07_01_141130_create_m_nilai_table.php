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
        Schema::create('m_nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->integer('indeks');
            $table->enum('status_approval_1', ['Pending', 'Approved', 'Reject', ''])->default('Pending');
            $table->enum('status_approval_2', ['Pending', 'Approved', 'Reject', ''])->default('Pending');
            $table->unsignedBigInteger('id_periode');
            $table->unsignedBigInteger('id_kompetensi');

            // foreign key
            $table->foreign('id_karyawan')->references('id')->on('m_karyawan');
            $table->foreign('id_periode')->references('id')->on('m_periode');
            $table->foreign('id_kompetensi')->references('id')->on('m_kompetensi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_nilai');
    }
};
