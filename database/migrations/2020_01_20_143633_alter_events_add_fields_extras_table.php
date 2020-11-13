<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventsAddFieldsExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('local')->nullable()->after('slug');
            $table->string('chopp_price')->nullable()->comment('Preço do chopp')->after('local');
            $table->string('trucks')->nullable()->comment('Caminhão')->after('chopp_price');
            $table->string('truck_driver')->nullable()->comment('Motorista')->after('trucks');
            $table->string('team')->nullable()->comment('Equipe')->after('truck_driver');
            $table->string('departure_date_and_time')->nullable()->comment('Data e horário de Saída da empresa')->after('team');
            $table->string('arrival_date_and_time')->nullable()->comment('Data e horário de Chegada no evento')->after('departure_date_and_time');
            $table->string('start_time_event')->nullable()->comment('Horário de Início do evento')->after('arrival_date_and_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
}
