@extends("dashboard.layouts.default")

@section("title")
	Colores
@stop

@section("pagina")
	<h2>Colores</h2>
@stop

@section("contenido")
	<form action="{{URL::route('colorSave')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<fieldset>
			<div class="col-md-6">
				<span style="color:red;">{{$errors->first('color')}}</span>
				<input type="text" class="form-control" name="color" value="{{Input::old('color')}}" placeholder="Color">
			</div>
			<input type="submit" value="Guardar" class="btn btn-success">
		</fieldset>
	</form>
	@if(count($c) > 0)
		<table class="table">
			<tr>
				<th>Color</th>
				<th colspan="2">Opciones</th>
			</tr>
		@foreach($c as $cc)
			<tr>
				<td>{{$cc->color}}</td>
				<td><a href="{{URL::route('colorEditForm')}}/{{$cc->id}}" class="label label-warning">editar</a></td>
				<td><a href="{{URL::route('colorDelete')}}/{{$cc->id}}" onclick="return confirm('¿Eliminar?')"class="label label-danger">X</a></td>
			</tr>
		@endforeach
		</table>
	@else
		<div class="alert alert-warning">
			No hay colores registrados...
		</div>
	@endif

@stop

@section("js")
@stop