<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->uuid('uuid');
            $table->unsignedBigInteger('lending_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('type',['in','out'])->default('in')->nullable();
            $table->text('description')->nullable();
            $table->status();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("lending_id")->on('lendings')->references('id')->onDelete("CASCADE");
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
        Schema::dropIfExists('movimentations');
    }
}
