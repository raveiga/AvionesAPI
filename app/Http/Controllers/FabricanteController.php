<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// Cargamos Fabricante por que lo usamos más abajo.
use App\Fabricante;

class FabricanteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// return "En el index de Fabricante.";
		// Devolvemos un JSON con todos los fabricantes.
		// return Fabricante::all();

		// Para devolver un JSON con código de respuesta HTTP.
		return response()->json(['status'=>'ok', 'data'=>Fabricante::all()],200);		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	// No se utiliza este método por que se usaría para mostrar un formulario
	// de creación de Fabricantes. Y una API REST no hace eso.
	/*
	public function create()
	{
		//
	}
	*/

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
	public function destroy($id)
	{
		//
	}

}
