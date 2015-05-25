<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePacientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pacientes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string,segundo_nombre('primer_nombre')->string,primer_apellido()->string,segundo_apellido()->string,fecha_nacimiento()->date,fecha_muerte()->date,id_pais()->integer,sexo()->string,tipo_documento()->string,documento()->string,tipo_paciente()->string,visible()->string();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pacientes');
	}

}
