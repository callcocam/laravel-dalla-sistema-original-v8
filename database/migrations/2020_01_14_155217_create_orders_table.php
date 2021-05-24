<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->uuid('uuid');
            $table->string('number',20)->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->decimal('price',9, 4)->nullable();
            $table->decimal('discount',9, 4)->nullable();
            $table->decimal('affix',9, 4)->nullable();
            $table->decimal('total',9, 4)->nullable();
            $table->date('delivery_date')->nullable();
            $table->text('description')->nullable();
            $table->status(['not-accepted','open','transit','completed']);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("client_id")->on('users')->references('id')->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
