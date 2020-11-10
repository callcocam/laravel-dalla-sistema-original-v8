<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stored_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->uuid('uuid');
            $table->string('verb')->nullable()->defaul('get');
            $table->string('prefix')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('route');
            $table->string('pattern')->nullable();
            $table->string('controller');
            $table->string('method')->nullable();
            $table->string('middleware')->nullable()->default('auth');
            $table->boolean('resource')->defaul(false);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('stored_routes');
    }
}
