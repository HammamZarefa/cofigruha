<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoTipoMaquinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado_tipo__maquina', function (Blueprint $table) {
            $table->foreignId('certificado_id')->constrained('certificados');
            $table->foreignId('tipo__maquina_id')->constrained('tipo_maquina');
            $table->primary(['certificado_id','tipo__maquina_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificado_tipo__maquina');
    }
}
