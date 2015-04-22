<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Fabricante;
use App\Avion;
use Response;

// Activamos caché.
use Illuminate\Support\Facades\Cache;

class FabricanteAvionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($idFabricante)
	{
		// Mostramos todos los aviones de un fabricante.
		// Comprobamos si el fabricante existe
		$fabricante=Fabricante::find($idFabricante);

		if (! $fabricante)
		{
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
		}

		$listaAviones=Cache::remember('cacheaviones',1,function()
		{
			return $fabricante->aviones()->get();
		});

		// Respuesta con caché.
		return response()->json(['status'=>'ok','data'=>$listaAviones],200);

		// Respuesta sin caché.
		// return response()->json(['status'=>'ok','data'=>$fabricante->aviones],200);
	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($idFabricante,Request $request)
	{
		// Damos de alta un avión de un fabricante.
		// Comprobamos que recibimos todos los datos de avión.
		if (! $request->input('modelo') || ! $request->input('longitud') ||! $request->input('capacidad') ||! $request->input('velocidad') ||! $request->input('alcance') )
		{
			// Error 422 Unprocessable Entity.
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el alta de avión.'])],422);
		}

		// Compruebo si existe el fabricante.
		$fabricante=Fabricante::find($idFabricante);

		if (! $fabricante)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
		}

		// Damos de alta el avión de ese fabricante.
		$nuevoAvion=$fabricante->aviones()->create($request->all());

		// Devolvemos un JSON con los datos, código 201 Created y Location del nuevo recurso creado.
		$respuesta= Response::make(json_encode(['data'=>$nuevoAvion]),201)->header('Location','http://www.dominio.local/aviones/'.$nuevoAvion->serie)->header('Content-Type','application/json');
		return $respuesta;

	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($idFabricante, $idAvion,Request $request)
	{
		// Comprobamos si el fabricante existe.
		$fabricante = Fabricante::find($idFabricante);

		if (!$fabricante)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
		}

		// Comprobamos si el avión que buscamos pertenece a ese fabricante.
		$avion = $fabricante->aviones()->find($idAvion);

		if (!$avion)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una avión  con ese código asociado al fabricante.'])],404);
		}

		// Listado de campos recibidos del formulario de actualización.
		$modelo=$request->input('modelo');
		$longitud=$request->input('longitud');
		$capacidad=$request->input('capacidad');
		$velocidad=$request->input('velocidad');
		$alcance=$request->input('alcance');

		// Comprobamos el método si es PATCH o PUT.
		if ($request->method()==='PATCH')	// Actualización PARCIAL.
		{
			$bandera=false;

			// Comprobamos campo a campo, si hemos recibido datos.
			if ($modelo)
			{
				// Actualizamos este campo en el modelo Avion.
				$avion->modelo=$modelo;
				$bandera=true;
			}

			if ($longitud)
			{
				// Actualizamos este campo en el longitud Avion.
				$avion->longitud=$longitud;
				$bandera=true;
			}

			if ($capacidad)
			{
				// Actualizamos este campo en el capacidad Avion.
				$avion->capacidad=$capacidad;
				$bandera=true;
			}

			if ($velocidad)
			{
				// Actualizamos este campo en el velocidad Avion.
				$avion->velocidad=$velocidad;
				$bandera=true;
			}

			if ($alcance)
			{
				// Actualizamos este campo en el alcance Avion.
				$avion->alcance=$alcance;
				$bandera=true;
			}

			// Comprobamos la bandera
			if ($bandera)
			{
				// Almacenamos los cambios del modelo en la tabla.
				$avion->save();
				return response()->json(['status'=>'ok','data'=>$avion],200);
			}
			else
			{
				//Código 304 Not modified.
				return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha modificado ningún dato de avión.'])],304);
			}
		}

		// Método PUT (actualización total)
		// Chequeamos que recibimos todos los campos.
		if (!$modelo || !$longitud || !$capacidad || !$velocidad || !$alcance)
		{
			// Código 422 Unprocessable Entity
			return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
		}

		// Actualizamos el Modelo Avion
		$avion->modelo=$modelo;
		$avion->longitud=$longitud;
		$avion->capacidad=$capacidad;
		$avion->velocidad=$velocidad;
		$avion->alcance=$alcance;

		// Grabamos los datos de avion en la tabla
		$avion->save();

		return response()->json(['status'=>'ok','data'=>$avion],200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($idFabricante,$idAvion)
	{
		// Compruebo si existe el fabricante.
		$fabricante=Fabricante::find($idFabricante);

		if (! $fabricante)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
		}

		// Compruebo si existe el avion.
		$avion=$fabricante->aviones()->find($idAvion);

		if (! $avion)
		{
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un avión asociado a ese fabricante.'])],404);
		}

		// Borramos el avión.
		$avion->delete();

		// Devolvemos código 204 No Content.
		return response()->json(['code'=>204,'message'=>'Se ha eliminado el avión correctamente.'],204);
	}
}
