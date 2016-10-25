@extends("dashboard.layouts.default")

@section("title")
	Imágenes
@stop

@section("css")
@stop

@section("pagina")
	<h2>Imágenes</h2>
@stop

@section("contenido")
	<fieldset>
		<a href="{{URL::route('imagenes')}}" class="btn btn-success pull-left">Cargar Imágenes</a>
	</fieldset>
	<table class="table">
		<tr>
			<th>Imagen</th>
			<th>Nombre</th>
		</tr>
		@foreach($imagenes as $img)
			<tr>
				<td><img src="uploads/images/{{$img->filename}}" width="80" height="80"></td>
				<td>{{$img->filename}}</td>
			</tr>
		@endforeach
	</table>
@stop

@section("js")
@stop
