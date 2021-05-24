<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->uuid('uuid');
            $table->string('number',20)->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('support_orders');
    }
}
