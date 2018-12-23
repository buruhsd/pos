<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_produk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sub_ref_produk_id')->default(0);
            $table->boolean('featured')->default(0);
            $table->string('nama');
            $table->text('gambar')->nullable();
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
        Schema::drop('ref_produk');
    }
}
