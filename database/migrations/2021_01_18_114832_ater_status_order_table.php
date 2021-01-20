<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AterStatusOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropColumns('orders',['status']);

        Schema::table('orders', function (Blueprint $table) {

            $table->enum('status',  ['not-accepted','open','in_billing','preparing','transit','completed'])->default('completed');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->removeColumn('status');
        });
    }
}
//Aguardando processamento;
//Não aceito;
//Em faturamento;
//Separando estoque / em carregamento;
//Em trânsito;
//Completo;
