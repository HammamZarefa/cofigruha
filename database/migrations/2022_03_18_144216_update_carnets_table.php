<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCarnetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carnet',function (Blueprint $table){
            $table->integer('tipo_1')->unsigned();
            $table->integer('tipo_2')->unsigned();
            $table->integer('tipo_3')->unsigned();
            $table->integer('tipo_4')->unsigned();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carnet', function(Blueprint $table) {
            $table->dropForeign('tipos_de_pemp');
        });
    }
}
