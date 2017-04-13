<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id_article');
            $table->integer('id_categorie')->nullable();
            $table->integer('id_fournisseur')->nullable();
            $table->string('num_article')->nullable();
            $table->string('code_barre')->nullable();
            $table->string('designation');
            $table->text('description')->nullable();
            $table->string('taille')->nullable();
            $table->string('couleur')->nullable();
            $table->string('sexe')->nullable();
            $table->float('prix', 20, 4)->nullable();
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
        Schema::dropIfExists('articles');
    }
}
