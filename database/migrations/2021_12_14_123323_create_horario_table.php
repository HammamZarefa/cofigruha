<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHorarioTable extends Migration {

	public function up()
	{
		Schema::create('horario', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('curso')->unsigned();
			$table->enum('contenido', array('Teoría', 'Práctica'));
			$table->datetime('fecha_inicio');
			$table->datetime('final');
			$table->integer('alumnos');
		});
	}

	public function down()
	{
		Schema::drop('horario');
	}
}