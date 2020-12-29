<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyewaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->increments('id_penyewaan');
            $table->string('alat_disewa', 45);
            $table->integer('lama_disewa');
            $table->date('tanggal_disewa');
            $table->date('tanggal_dikembalikan');
            $table->longtext('deskripsi')->nullable();
            $table->integer('id_pembayaran')->nullable();
            $table->integer('id_admin')->nullable();
            $table->integer('id_penyedia')->nullable();
            $table->integer('user_id');
            $table->string('status', 45);
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
        Schema::dropIfExists('penyewaan');
    }
}
