<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCarnetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carnet', function(Blueprint $table) {
            $table->dropForeign('tipos_1');
            $table->dropForeign('tipos_2');
            $table->dropForeign('tipos_3');
            $table->dropForeign('tipos_4');
        });
    }
}
