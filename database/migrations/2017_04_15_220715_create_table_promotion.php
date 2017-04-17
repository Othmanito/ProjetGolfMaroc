<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePromotion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('promotions', function (Blueprint $table) {
          $table->increments('id_promo');
          $table->integer('id_magasin');
          $table->integer('id_article');
          $table->string('description');
          $table->date('date_debut');
          $table->date('date_fin');
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
        //
    }
}
