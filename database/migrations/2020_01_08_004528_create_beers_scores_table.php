<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeersScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beers_scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->unsignedBigInteger('visits_distributor_id');
            $table->uuid('uuid');
            $table->string('name',255)->nullable();
            $table->string('assets',50)->default('question-01')->nullable();
            $table->string('selected',100)->nullable();
            $table->date('date_option')->nullable();
            $table->text('description')->nullable();
            $table->status();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("visits_distributor_id")->on('events')->references('id')->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beers_scores');
    }
}
