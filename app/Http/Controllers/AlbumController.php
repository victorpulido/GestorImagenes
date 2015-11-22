<?php namespace GestorImagenes\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use GestorImagenes\Http\Requests\CrearAlbumRequest;
use GestorImagenes\Album;

class AlbumController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{

		$usuario = Auth::user();
		$albumes = $usuario->albumes;

		return view('albumes.mostrar',['albumes' => $albumes]);
	}
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getCrearAlbum()
	{
		return view('albumes.crear-album');
	}

	public function postCrearAlbum(CrearAlbumRequest $request)
	{
		$usuario = Auth::user();

		Album::create(
			[
				'nombre' => $request->get('nombre'),
				'descripcion' => $request->get('descripcion'),
				'usuario_id' => $usuario->id
			]


		);

		return redirect('/validado/albumes')->with('creado','Album creado');
	}

	public function getActualizarAlbum()
	{
		return 'formulario actualizar Album';
	}

	public function postActualizarAlbum()
	{
		return 'actualizando Album';
	}

	public function getEliminarAlbum()
	{
		return 'formulario eliminar Album';
	}

	public function postEliminarAlbum()
	{
		return 'eliminando Album';
	}

	public function missingMethod($parameters = array())
	{
		abort(404);
	}
}