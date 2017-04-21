<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('transactions', function (Blueprint $table) {
        $table->foreign('id_user')->references('id_user')->on('users')
                      ->onDelete('restrict')
                      ->onUpdate('restrict');
        $table->foreign('id_magasin')->references('id_magasin')->on('magasins')
                      ->onDelete('restrict')
                      ->onUpdate('restrict');
        $table->foreign('id_typeTrans')->references('id_typeTrans')->on('type_transaction')
                      ->onDelete('restrict')
                      ->onUpdate('restrict');
        $table->foreign('id_paiement')->references('id_paiement')->on('users')
                      ->onDelete('restrict')
                      ->onUpdate('restrict');
      });

      Schema::table('trans_article', function (Blueprint $table) {
        $table->foreign('id_transaction')->references('id_transaction')->on('transactions')
                      ->onDelete('restrict')
                      ->onUpdate('restrict');
        $table->foreign('id_article')->references('id_article')->on('articles')
                      ->onDelete('restrict')
                      ->onUpdate('restrict');

      });

      Schema::table('paiements', function (Blueprint $table) {
        $table->foreign('id_mode')->references('id_mode')->on('mode_paiements')
                      ->onDelete('restrict')
                      ->onUpdate('restrict');


      });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
