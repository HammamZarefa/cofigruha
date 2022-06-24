<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCursosTable extends Migration {

	public function up()
	{
		Schema::create('cursos', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('curso', 255);
			$table->integer('tipo_curso')->unsigned();
			$table->integer('tipo_maquina_1')->unsigned();
			$table->integer('tipo_maquina_2')->unsigned();
			$table->integer('tipo_maquina_3')->unsigned();
			$table->integer('tipo_maquina_4')->unsigned();
			$table->string('codigo', 255);
			$table->integer('entidad')->unsigned();
			$table->integer('formador')->unsigned();
			$table->integer('formador_apoyo_1')->unsigned()->nullable();
			$table->integer('formador_apoyo_2')->unsigned()->nullable();
			$table->integer('formador_apoyo_3')->unsigned()->nullable();
			$table->datetime('fecha_inicio')->nullable();
			$table->string('direccion', 255)->nullable();
			$table->string('ciudad', 255)->nullable();
			$table->string('provincia', 255)->nullable();
			$table->string('codigo_postal')->nullable();
			$table->integer('examen-t')->unsigned();
			$table->integer('examen-p')->unsigned();
			$table->string('asistentes_pdf', 255)->nullable();
			$table->datetime('fecha_alta')->nullable();
			$table->boolean('publico-privado');
			$table->string('observaciones', 255)->nullable();
			$table->boolean('cerrado');
			$table->boolean('estado');
		});
	}

	public function down()
	{
		Schema::drop('cursos');
	}
}
