<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->tenant();
                $table->user();
                $table->uuid('uuid');
                $table->string('name')->nullable();
                $table->string('fullPath')->nullable();
                $table->string('dir')->nullable()->default('/dist/upload/images');
                $table->string('fileType')->nullable()->default('image/jpeg');
                $table->string('ext')->nullable()->default('jpg');
                $table->string('size')->nullable();
                $table->integer('width')->nullable();
                $table->integer('height')->nullable();
                $table->morphs('fileable');
                $table->string('description')->nullable();
                $table->status();
                $table->softDeletes();
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
        Schema::dropIfExists('files');
    }
}
