<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsistentTable extends Migration {

	public function up()
	{
		Schema::create('asistent', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('curso')->unsigned();
			$table->integer('orden')->nullable();
			$table->integer('operador')->unsigned();
			$table->integer('tipo_carnet')->unsigned();
            $table->string('tipos_carnet')->nullable();
			$table->integer('nota_t')->nullable();
			$table->integer('nota_p');
			$table->string('examen_t_pdf', 255)->nullable();
			$table->string('examen_p_pdf', 255)->nullable();
			$table->integer('tipo_1')->unsigned();
			$table->integer('tipo_2')->unsigned();
			$table->integer('tipo_3')->unsigned();
			$table->integer('tipo_4')->unsigned();
			$table->date('emision')->nullable();
			$table->date('vencimiento')->nullable();
			$table->string('observaciones', 255)->nullable();
			$table->datetime('rememberToken')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('asistent');
	}
}
