<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits_distributors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tenant();
            $table->user();
            $table->uuid('uuid');
            $table->string('name',255)->nullable();
            $table->string('fantasy',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->string('resbonsible')->comment('Responsavel')->nullable();
            $table->string('phone')->comment('Telefone')->nullable();
            $table->date('date_visit')->comment('Data da visita')->nullable();
            $table->text('cities_serving_region')->comment('Cidades que atende na região')->nullable();
            $table->text('meet_each_city')->comment('De que forma atende em cada cidade')->nullable();
            $table->text('disclose_and_increase_sales')->comment('Qual foram as ações efetuadas pela distribuidora no sentido de divulgar e aumentar as vendas do chopp dalla?')->nullable();
            $table->text('date_works')->comment('Quais ações e em qual data pode ser efetuado um trabalho no ano de 2020')->nullable();
            $table->text('considerations_distributor')->comment('Considerações final do distribuidor')->nullable();
            $table->text('considerations_beer')->comment('Considerações final da cevejaria')->nullable();
            $table->text('comparative_privious_year')->comment('Comparativo de crescimento em relação ao ano anterior')->nullable();
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
        Schema::dropIfExists('visits_distributors');
    }
}
