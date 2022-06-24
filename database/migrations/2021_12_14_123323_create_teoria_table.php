<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeoriaTable extends Migration {

	public function up()
	{
		Schema::create('teoria', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('formacion', 255);
			$table->string('codigo', 255);
			$table->string('examen', 255);
			$table->date('fecha');
		});
	}

	public function down()
	{
		Schema::drop('teoria');
	}
}