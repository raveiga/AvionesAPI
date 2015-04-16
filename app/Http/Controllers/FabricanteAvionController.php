<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Fabricante;
use App\Avion;
use Response;

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

		return response()->json(['status'=>'ok','data'=>$fabricante->aviones()->get()],200);
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
	public function update($id)
	{
		//
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