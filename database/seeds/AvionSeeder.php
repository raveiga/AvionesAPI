<?php

use Illuminate\Database\Seeder;

// Hace uso del modelo de Avion.
use App\Avion;

// Hace uso del modelo de Fabricante para averiguar cuantos fabricantes hay actualmente.
use App\Fabricante;

// Utiliza el faker
use Faker\Factory as Faker;

class AvionSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Creamos una instancia de Faker
		$faker= Faker::create();

		// Necesitamos saber cuantos fabricantes tenemos.
		$cuantos = Fabricante::all()->count();

		// Creamos un bucle para cubrir 20 aviones.
		for ($i=0; $i<19; $i++)
		{
			Avion::create(
				[
					'modelo'=>$faker->word(),
					'longitud'=>$faker->randomFloat(),
					'capacidad'=>$faker->randomNumber(),
					'velocidad'=>$faker->randomNumber(),
					'alcance'=>$faker->randomNumber(),
					'fabricante_id'=>$faker->numberBetween(1,$cuantos)			
				]);

		}

	}

}