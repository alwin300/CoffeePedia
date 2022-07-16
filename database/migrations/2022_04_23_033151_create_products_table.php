<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('username');
            $table->string('nama');
			$table->string('jenis');
			$table->integer('harga');
            $table->integer('stok');
            $table->integer('berat');
			$table->text('deskripsi');
            $table->string('asal');
            $table->integer('diskon')->nullable();
            $table->integer('total')->nullable();
			$table->string('image');
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
        Schema::dropIfExists('products');
    }
}
