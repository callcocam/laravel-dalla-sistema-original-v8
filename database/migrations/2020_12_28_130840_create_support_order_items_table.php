<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->uuid('uuid');
            $table->unsignedBigInteger('support_order_id')->nullable();
            $table->unsignedBigInteger('support_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('price')->nullable();
            $table->integer('total')->nullable();
            $table->text('description')->nullable();
            $table->status();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("support_order_id")->on('support_orders')->references('id')->onDelete("CASCADE");
            $table->foreign("support_id")->on('support_materials')->references('id')->onDelete("CASCADE");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_order_items');
    }
}
