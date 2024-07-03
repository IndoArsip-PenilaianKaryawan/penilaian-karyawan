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
        Schema::create('m_bidang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bidang');
            $table->unsignedBigInteger('id_departement');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_departement')->references('id')->on('m_departement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_bidang');
    }
};
