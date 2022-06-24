<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoMaquinaTable extends Migration {

	public function up()
	{
		Schema::create('tipo_maquina', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('tipo_maquina', 255);
		});
	}

	public function down()
	{
		Schema::drop('tipo_maquina');
	}
}