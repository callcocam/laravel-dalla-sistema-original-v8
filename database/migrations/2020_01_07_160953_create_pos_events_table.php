<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->unsignedBigInteger('event_id');
            $table->uuid('uuid');
            $table->string('customer_service',255)->nullable();
            $table->string('draft_beer_quality',255)->nullable();
            $table->string('event_structure',255)->nullable();
            $table->string('amount_beer_consumed',255)->nullable();
            $table->string('make_new_event',255)->nullable();
            $table->string('team_uniform',255)->nullable();
            $table->text('pos_description')->nullable();
            $table->status();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("event_id")->on('events')->references('id')->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_events');
    }
}
