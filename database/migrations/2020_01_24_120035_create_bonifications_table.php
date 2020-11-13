<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->uuid('uuid');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('bonu_id')->nullable();
            $table->integer('amount')->nullable();
            $table->status();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("client_id")->on('users')->references('id')->onDelete("CASCADE");
            $table->foreign("product_id")->on('products')->references('id')->onDelete("CASCADE");
            $table->foreign("bonu_id")->on('bonus')->references('id')->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonifications');
    }
}
