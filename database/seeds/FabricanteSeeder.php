<?php

use Illuminate\Database\Seeder;

// Hace uso del modelo Fabricante
use App\Fabricante;

// Usamos el Faker que instalamos antes.
use Faker\Factory as Faker;

class FabricanteSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Creamos una instancia de Faker
		$faker=Faker::create();

		// Vamos a cubrir 5 fabricantes.
		for ($i=0; $i<5; $i++)
		{
			// Cuando llamamos al metodo create del Modelo Fabricante
			// se está creando una nueva fila en la tabla de Fabricantes.
			// Ver info. de Active Record - Eloquent ORM.
			Fabricante::create(
				[
				'nombre'=>$faker->word(),
				'direccion'=>$faker->word(),
				'telefono'=>$faker->randomNumber()
				]);
		}

	}

}