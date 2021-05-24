<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldUpdatedByEbsevationToEventTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('updated_by')->nullable()->after('user_id');
            $table->text('observations')->nullable()->after('description');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_tasks', function (Blueprint $table) {
            //
        });
    }
}
