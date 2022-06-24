<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamenTable extends Migration {

	public function up()
	{
		Schema::create('examen', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('codigo', 255);
			$table->enum('tipo', array('T-Theoretical', 'P-Practical'));
			$table->string('nombre', 255);
			$table->string('url', 255);
		});
	}

	public function down()
	{
		Schema::drop('examen');
	}
}