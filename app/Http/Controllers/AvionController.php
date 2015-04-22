<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Avion;

// Activamos caché.
use Illuminate\Support\Facades\Cache;

class AvionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$listaAviones=Cache::remember('cacheTodosAviones',5,function()
		{
			return Avion::all();
		});

		// Devuelve la lista de todos los aviones desde caché.
		return response()->json(['status'=>'ok','data'=>$listaAviones],200);

		// Devuelve la lista de todos los aviones sin caché.
		// return response()->json(['status'=>'ok','data'=>Avion::all()],200);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// Buscamos ese avion y si lo encuentra muestra la info.
		$avion=Avion::find($id);

		if (!$avion)
		{
			return response()->json(['errors'=>['code'=>404,'message'=>'No se encuentra un avion con ese código']],404);
		}

		return response()->json(['status'=>'ok','data'=>$avion],200);
	}

}