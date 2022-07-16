<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('user_id');
            $table->string('namalengkap');
            $table->string('notelp');
            $table->integer('province_id');
            $table->string('nama_provinsi');
            $table->integer('kota_id');
            $table->string('nama_kota');
            $table->string('kurir');
            $table->string('layanan');
            $table->text('alamat');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->integer('kodepos');
            $table->integer('total');
            $table->string('image');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
