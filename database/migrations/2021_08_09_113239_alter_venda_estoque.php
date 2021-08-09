<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVendaEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estoque', function (Blueprint $table) {
            $table->bigInteger('estoque_categoria_id')->unsigned()->nullable();
            $table->foreign('estoque_categoria_id')->references("id")->on('estoque_categoria');
        });
        Schema::table('venda', function (Blueprint $table) {
            $table->bigInteger('venda_categoria_id')->unsigned()->nullable();
            $table->foreign('venda_categoria_id')->references("id")->on('venda_categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estoque', function (Blueprint $table) {
            //
        });
        Schema::table('venda', function (Blueprint $table) {
            //
        });
    }
}
