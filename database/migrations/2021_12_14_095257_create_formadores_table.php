<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormadoresTable extends Migration {

	public function up()
	{
		Schema::create('formadores', function(Blueprint $table) {
			$table->id()->unsigned();
			$table->timestamps();
			$table->softDeletes();
			$table->string('codigo', 255);
			$table->integer('entidad')->unsigned();
			$table->string('apellidos', 255);
			$table->string('nombre', 255);
			$table->string('dni', 255);
			$table->string('dni_img', 255);
			$table->string('operador_pdf', 255)->nullable();
			$table->string('cert_empresa_pdf', 255)->nullable();
			$table->string('vida_laboral_pdf', 255)->nullable();
			$table->string('prl_pdf', 255)->nullable();
			$table->string('pemp_pdf', 255)->nullable();
			$table->string('cap_pdf', 255)->nullable();
			$table->date('fecha')->nullable();
			$table->boolean('estado');
		});
	}

	public function down()
	{
		Schema::drop('formadores');
	}
}