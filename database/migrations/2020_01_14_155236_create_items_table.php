<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->uuid('uuid');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->decimal('amount')->nullable();
            $table->decimal('price',9, 4)->nullable();
            $table->decimal('total',9, 4)->nullable();
            $table->text('description')->nullable();
            $table->status();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("order_id")->on('orders')->references('id')->onDelete("CASCADE");
            $table->foreign("product_id")->on('products')->references('id')->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
