<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('email')->unique();
            $table->string('phone', 20)->nullable();
            $table->string('document', 20)->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender',['male','female'])->default('male')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->text('description')->nullable();
            $table->status();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
