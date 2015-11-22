@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

			@if (Session::has('actualizado'))
						<div class="alert alert-success">
							<strong>Ok!</strong> El perfil se actualizó.<br><br>
							{{Session::get('actualizado')}}
						</div>
					@endif


			<div class="panel panel-default">
				
			<div class="panel-heading">Inicio</div>
			
				<div class="panel-body">
					Bienvenido {{Auth::user()->nombre}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
