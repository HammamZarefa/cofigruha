<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('formadores', function(Blueprint $table) {
			$table->foreign('entidad')->references('id')->on('entidades_formadoreas')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('formadores', function(Blueprint $table) {
			$table->dropForeign('formadores_entidad_foreign');
		});
	}
}