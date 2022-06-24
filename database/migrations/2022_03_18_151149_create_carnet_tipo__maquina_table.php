<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarnetTipoMaquinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carnet_tipo__maquina', function (Blueprint $table) {
            $table->foreignId('carnet_id')->constrained('carnet');
            $table->foreignId('tipo__maquina_id')->constrained('tipo_maquina');
            $table->primary(['carnet_id','tipo__maquina_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carnet_tipo__maquina');
    }
}
