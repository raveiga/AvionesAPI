<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AvionesMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aviones', function(Blueprint $table)
		{
			$table->increments('serie');
			$table->string('modelo');
			$table->float('longitud');
			$table->integer('capacidad');
			$table->integer('velocidad');
			$table->integer('alcance');
			// Nos falta un campo por definir
			// el de la foreign key.
			$table->integer('fabricante_id')->unsigned();
			$table->timestamps();

			// Por último definimos la clave foránea.
			$table->foreign('fabricante_id')->references('id')->on('fabricantes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aviones');
	}

}
