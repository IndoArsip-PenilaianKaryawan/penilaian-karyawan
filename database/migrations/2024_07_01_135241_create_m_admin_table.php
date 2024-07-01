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
        Schema::create('m_admin', function (Blueprint $table) {
            $table->id(); // Membuat kolom id sebagai primary key dengan auto increment
            $table->string('username')->unique(); // Membuat kolom username dengan indeks unik
            $table->string('password'); // Membuat kolom password
            $table->string('name'); // Membuat kolom password
            $table->timestamps(); // Membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_admin');
    }
};
