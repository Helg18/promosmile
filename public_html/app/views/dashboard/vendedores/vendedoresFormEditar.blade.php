@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
	<h2>Editar vendedor</h2>
@stop

@section("contenido")
	<form action="{{URL::route('vendedoresEditar')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$vendedor->id}}">

		<div class="form-group">
			<div class="col-md-4" >
				<label for="">Nombre 

	                {{($errors->first("nombre")) ? $errors->first("nombre")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="nombre" value="{{$vendedor->nombre}}" class="form-control" id="inputSeleccionado" class="form-control" placeholder="Ingresar Nombre">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Apellido Paterno
	                {{($errors->first("apellidopaterno")) ? $errors->first("apellidopaterno")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="apellidopaterno" value="{{$vendedor->apellidopaterno}}" class="form-control" placeholder="Ingresar Apellido Paterno">
			</div>
		</div>	

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Apellido  Materno
	                {{($errors->first("apellidomaterno")) ? $errors->first("apellidomaterno")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="apellidomaterno" value="{{$vendedor->apellidomaterno}}" class="form-control" placeholder="Ingresar Apellido Materno">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">E-mail 
	                {{($errors->first("email")) ? $errors->first("email")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="email" name="email" value="{{$vendedor->email}}" class="form-control" placeholder="Ingresar E-mail">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Telefono
	                {{($errors->first("telefono")) ? $errors->first("telefono")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="varchar" name="telefono" value="{{$vendedor->telefono}}" class="form-control" placeholder="Ingresar Telefono">
			</div>
		</div>

		<div class="col-md-10" >
			<div class="form-group">	
				<input type="submit" class="btn btn-success" value="Modificar">
				<a class="btn btn-warning" href="{{URL::route('vendedores')}}" >Regresar</a>
			</div>
		</div>
	</form>
@stop

@section("js")
@stop