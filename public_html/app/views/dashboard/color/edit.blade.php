@extends("dashboard.layouts.default")

@section("title")
	Editar color
@stop

@section("pagina")
	<h2>Editar color</h2>
@stop

@section("contenido")
	<form action="{{URL::route('colorEdit')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$c->id}}">
		<fieldset>
			<div class="col-md-6">
				<span style="color:red;">{{$errors->first('color')}}</span>
				<input type="text" class="form-control" name="color" value="{{$c->color}}" placeholder="Color">
			</div>
			<input type="submit" value="Modificar" class="btn btn-success">
		</fieldset>
	</form>
@stop

@section("js")
@stop