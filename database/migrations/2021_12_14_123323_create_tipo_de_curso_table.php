<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoDeCursoTable extends Migration {

	public function up()
	{
		Schema::create('tipo_de_curso', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('tipo_curso', 255);
			$table->string('codigo', 255);
		});
	}

	public function down()
	{
		Schema::drop('tipo_de_curso');
	}
}