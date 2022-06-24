<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero', 255);
            $table->integer('operador')->unsigned();
            $table->integer('entidad')->unsigned();
            $table->integer('curso')->unsigned();
            $table->date('emision')->nullable();
            $table->date('vencimiento')->nullable();
            $table->string('observaciones', 255)->nullable();
            $table->date('cer_fecha')->nullable();
            $table->string('cer_apellidos', 255);
            $table->string('cer_nombre', 255);
            $table->string('dni', 255);
            $table->string('cer_type_course', 255);
            $table->datetime('fecha_alta')->nullable();
            $table->string('entidad_nombre', 255);
            $table->string('tipos_carnet')->nullable();
            $table->string('carnet', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificados');
    }
}
