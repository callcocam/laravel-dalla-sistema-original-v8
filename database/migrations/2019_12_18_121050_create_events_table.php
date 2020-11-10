<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('subtitle')->nullable();
            $table->dateTime('start_event')->nullable();
            $table->dateTime('end_event')->nullable();
            $table->integer('consumption')->nullable();
            $table->text('description')->nullable();
            $table->status();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('client_id')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
