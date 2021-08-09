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
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->text('images')->nullable(false);
            $table->integer('prize')->nullable(false);
            $table->integer('finalPrize')->nullable(false);
            $table->integer('availability')->nullable(false);
            $table->string('discription')->nullable(false);
            $table->string('brand')->nullable(false);
            $table->string('season')->nullable(false);
            $table->string('color')->nullable(false);
            $table->string('fit')->nullable(false);
            $table->string('size')->nullable(false);
            $table->string('category')->nullable(false);
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
