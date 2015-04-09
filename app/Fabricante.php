<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model {

	// Definir la tabla MySQL que usará este modelo.
	protected $table="fabricantes";

	// Atributos de la tabla que se pueden rellenar de forma masiva.
	protected $fillable=array('nombre','direccion','telefono');

	// Ocultamos los campos de timestamps en las consultas.
	protected $hidden=['created_at','updated_at'];

	// Relación de Fabricante con Aviones:
	public function aviones()
	{
		// La relación sería: 1 fabricante tiene muchos aviones.
		return $this->hasMany('App\Avion');
	}

}
