<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use GestorImagenes\Album;
use GestorImagenes\Foto;
use GestorImagenes\Usuario;


class FotosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$albumes= Album::all();

		foreach($albumes as $album)
		{
			$cantidad= rand(0,15);	
			for ($i=0;$i<$cantidad;$i++)
			{
				Foto::create(
					[
						'nombre' => "foto$i",
						'descripcion' => "descripcion$i",
						'ruta' => "/img/test$i.jpg",
						'album_id' => $album->id
						
					]);
			}
		}
	}

}
