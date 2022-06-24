<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarnetTable extends Migration {

	public function up()
	{
		Schema::create('carnet', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('numero', 255);
			$table->integer('operador')->unsigned();
			$table->string('foto', 255)->nullable();
			$table->date('fecha_de_alta')->nullable();
			$table->date('fecha_de_emision')->nullable();
			$table->string('tipos_de_pemp', 255)->nullable();
			$table->integer('curso')->unsigned();
			$table->boolean('estado');
			$table->enum('examen_teorico_realizado', array('básico', 'Extendido'));
		});
	}

	public function down()
	{
		Schema::drop('carnet');
	}
}