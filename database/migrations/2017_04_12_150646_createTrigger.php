<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::unprepared('CREATE TRIGGER add_trans_Article AFTER INSERT ON `transactions` FOR EACH ROW
                      BEGIN
                         INSERT INTO trans_article(id_transaction) VALUES (NEW.id_transaction);
                      END');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::unprepared('DROP TRIGGER `add_trans_Article`');


    }
}
