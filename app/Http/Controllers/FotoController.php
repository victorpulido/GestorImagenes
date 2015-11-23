<?php namespace GestorImagenes\Http\Controllers;

use GestorImagenes\Http\Requests\MostrarFotosRequest;
use GestorImagenes\Http\Requests\CrearFotoRequest;
use GestorImagenes\Http\Requests\ActualizarFotoRequest;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GestorImagenes\Album;
use GestorImagenes\Foto;
class FotoController extends Controller {

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

	public function getIndex(MostrarFotosRequest $request)
	{
		$id = $request->get('id');
		$fotos = Album::find($id)->fotos;
		$album = Album::find($id);
		return view('fotos.mostrar',[ 'fotos' => $fotos, 'id' => $id,'nombre_album'=>$album->nombre]);
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getCrearFoto(Request $request)
	{
		$id = $request->get('id');
		//$album = Album::find($id);
		return view('fotos.crear-foto',['id'=>$id]);
	}

	public function postCrearFoto(CrearFotoRequest $request)
	{
		$id = $request->get('id');
		$imagen = $request->file('imagen');
		$ruta = '/img/';
		$nombre = sha1(Carbon::now()).'.'.$imagen->guessExtension();
		$imagen->move(getcwd().$ruta, $nombre);
		Foto::create
		(
			[
				'nombre' => $request->get('nombre'),
				'descripcion' => $request->get('descripcion'),
				'ruta' => $ruta.$nombre,
				'album_id' => $id
			]
		);
		return redirect("/validado/fotos?id=$id")->with('creada', 'La foto ha sido subida');
	}

	public function getActualizarFoto($id)
	{
		$foto = Foto::find($id);
		return view('fotos.actualizar-foto',['foto'=>$foto]);
	}

	public function postActualizarFoto(ActualizarFotoRequest $request)
	{
		$foto = Foto::find($request->get('id'));
		$foto->nombre=$request->get('nombre');
		$foto->descripcion=$request->get('descripcion');

		if ($request->hasFile('imagen'))
		{
			$imagen = $request->file('imagen');
			$ruta = '/img/';
			$nombre = sha1(Carbon::now()).'.'.$imagen->guessExtension();
			$imagen->move(getcwd().$ruta, $nombre);

			$rutaanterior = getcwd().$foto->ruta;

			@unlink(realpath($rutaanterior));

			$foto->ruta=$ruta.$nombre;
		}
			$foto->save();

			return redirect("/validado/fotos?id=$foto->album_id")->with('editada','Foto editada con éxito.');
		
	}


	public function postEliminarFoto()
	{
		return 'eliminando foto';
	}

	public function missingMethod($parameters = array())
	{
		abort(404);
	}
}