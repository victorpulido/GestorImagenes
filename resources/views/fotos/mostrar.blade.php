@extends('app')

@section('content')



<div class="container-fluid">
<h3>{{ $nombre_album }}</h3>	
<p><a href="/validado/fotos/crear-foto?id={{$id}}" class="btn btn-primary" role="button">Crear Foto</a></p>

@if(sizeof($fotos)>0)
	@foreach($fotos as $index => $foto)
		@if($index%4 == 0)
		<div class="row">
		@endif
		  <div class="col-sm-6 col-md-3">
		    <div class="thumbnail">
		    	<img src="{{$foto->ruta}}">
		      <div class="caption">
		        <h3>{{$foto->nombre}}</h3>
		        <p>{{$foto->descripcion}}</p>
		      </div>
		      <p><a href="/validado/fotos/actualizar-foto/{{$foto->id}}" class="btn btn-primary" role="button">Editar Foto</a></p>
		      <form action="/validado/fotos/eliminar-foto" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" required>
				<input type="hidden" name="id" value="{{$foto->id}}" required>
				<input class="btn btn-danger" role="button" type="submit" value="Eliminar"/>
			</form>
		    </div>
		  </div>
		@if(($index+1)%4 == 0)
		</div>
		@endif
	@endforeach
@else
<div class="alert alert-danger">
	<p>No existen fotos a mostrar.</p>
</div>

@endif
</div>
@endsection
