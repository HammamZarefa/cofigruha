<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntidadesFormadoreasTable extends Migration {

	public function up()
	{
		Schema::create('entidades_formadoreas', function(Blueprint $table) {
			$table->integer('id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('socio');
			$table->string('cif', 255);
			$table->string('nombre', 255);
			$table->string('razon_social')->nullable();
			$table->string('province', 255)->nullable();
			$table->string('ciudad', 255);
			$table->string('direccion', 255);
			$table->string('codigo_postal');
			$table->string('logo', 255);
			$table->string('web', 255);
			$table->string('mail', 255);
			$table->string('doc_medios_pdf', 255)->nullable();
			$table->date('fecha');
			$table->boolean('estado');
			$table->boolean('certificado');
		});
	}

	public function down()
	{
		Schema::drop('entidades_formadoreas');
	}
}
