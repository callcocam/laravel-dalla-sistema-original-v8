<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsVisitsDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visits_distributors', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable()->after('uuid');
            $table->renameColumn('name','quantity_of_distributor_draft_beer')->nullable()->comment('Quantidade de chopeiras do distribuidor')->after('date_visit')->change();
            $table->renameColumn('slug','quantity_of_matriz_draft_beer')->nullable()->comment('Quantidade de chopeiras da Dalla Carvejaria')->after('quantity_of_distributor_draft_beer')->change();
            $table->renameColumn('fantasy','number_of_distributor_barrels')->nullable()->comment('Quantidade de barris do distribuidor')->after('quantity_of_matriz_draft_beer')->change();
            $table->renameColumn('phone','number_of_matriz_barrels')->nullable()->comment('Quantidade de barris da Dalla Cervejaria')->after('number_of_distributor_barrels')->change();
            $table->foreign("client_id")->on('users')->references('id')->onDelete("SET NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visits_distributors', function (Blueprint $table) {
            //
        });
    }
}
