<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 80);
            $table->string("codigo", 20);
            $table->string("marca", 80);
            $table->string("preco", 20);
            $table->string("cliente_nome", 100);
            $table->string("cliente_cpf", 50);
            $table->string("cliente_telefone", 50);
            $table->string("descricao", 150);
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
        Schema::dropIfExists('venda');
    }
}
