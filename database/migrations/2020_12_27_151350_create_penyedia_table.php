<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyedia', function (Blueprint $table) {
            $table->increments('id_penyedia');
            $table->string('nama_penyedia', 45);
            $table->string('email_penyedia', 45);
            $table->string('no_hp_penyedia', 20);
            $table->string('alamat_penyedia', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyedia');
    }
}
