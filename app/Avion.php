<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Avion extends Model {

	// Nombre de la tabla en MySQl
	protected $table='aviones';

	// Clave primaria de la tabla aviones.
	// En este caso es el campo serie, por lo tanto hay que indicarlo.
	// Si no se indica, por defecto sería un campo llamado "id".
	protected $primaryKey='serie';

	// Campos de la tabla que se pueden asignar masivamente
	protected $fillable=array('modelo','longitud','capacidad','velocidad','alcance');

	// Campos que no queremos que se devuelvan en las consultas.
	protected $hidden=['created_at','updated_at'];

	// Definimos la relación de Avión con Fabricante.
	public function fabricante()
	{
		// 1 avión pertenece a 1 fabricante.
		return $this->belongsTo('App\Fabricante');
	}

}
