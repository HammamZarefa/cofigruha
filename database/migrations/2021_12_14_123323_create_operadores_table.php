<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOperadoresTable extends Migration {

	public function up()
	{
		Schema::create('operadores', function(Blueprint $table) {
			$table->integer('id', true);
			$table->timestamps();
			$table->softDeletes();
			$table->string('dni', 255);
			$table->string('apellidos', 255);
			$table->string('nombre', 255);
			$table->integer('entidad')->unsigned();
			$table->string('foto', 255)->nullable();
			$table->string('dni_img', 255)->nullable();
			$table->date('fecha_nacimiento')->nullable();
			$table->string('provincia', 255)->nullable();
			$table->string('ciudad', 255)->nullable();
			$table->string('direccion', 255)->nullable();
			$table->string('codigo_postal')->nullable();
			$table->string('mail', 255)->nullable();
			$table->string('carnet', 255)->nullable();
			$table->date('fecha')->nullable();
			$table->boolean('estado');
		});
	}

	public function down()
	{
		Schema::drop('operadores');
	}
}
