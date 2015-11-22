<?php namespace GestorImagenes\Http\Controllers;

class UsuarioController extends Controller {

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

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getEditarPerfil()
	{
		return 'mostrando formulario de perfil del usuario';
	}

	public function postEditarPerfil()
	{
		return 'actualizando perfil';
	}

	public function missingMethod($parameters = array())
	{
		abort(404);
	}
}