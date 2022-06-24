<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePracticaTable extends Migration {

	public function up()
	{
		Schema::create('practica', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('practica', 255);
			$table->string('codigo', 255);
			$table->string('maquina_1', 255);
			$table->string('maquina_2', 255);
			$table->string('maquina_3', 255);
			$table->string('maquina_4', 255);
			$table->string('examen', 255);
		});
	}

	public function down()
	{
		Schema::drop('practica');
	}
}