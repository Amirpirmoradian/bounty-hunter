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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('mootanroo_id');
            $table->string('name');
            $table->decimal('price', 20);
            $table->tinyText('media_url');
            $table->timestamps();
        });

        Schema::create('product_seller', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('seller_id');
            $table->integer('quantity');
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
        Schema::dropIfExists('product_seller');
    }
};
