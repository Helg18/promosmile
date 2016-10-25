@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
	<h2>Editar Usuario</h2>
@stop

@section("contenido")
	<form action="{{URL::route('usuariosEditar')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$usuarios->id}}">

		<div class="form-group">
			<div class="col-md-4" >
				<label for="">Nombres 

	                {{($errors->first("nombre")) ? $errors->first("nombre")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="first_name" value="{{$usuarios->first_name}}" class="form-control" id="inputSeleccionado" class="form-control" placeholder="Ingresar Nombre">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Apellidos
	                {{($errors->first("apellidopaterno")) ? $errors->first("apellidopaterno")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="last_name" value="{{$usuarios->last_name}}" class="form-control" placeholder="Ingresar Apellido Paterno">
			</div>
		</div>	

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Usuario
	                {{($errors->first("apellidomaterno")) ? $errors->first("apellidomaterno")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="username" value="{{$usuarios->username}}" class="form-control" placeholder="Ingresar Apellido Materno">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">E-mail 
	                {{($errors->first("email")) ? $errors->first("email")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="email" name="email" value="{{$usuarios->email}}" class="form-control" placeholder="Ingresar E-mail">
			</div>
		</div>


		<div class="col-md-10" >
			<div class="form-group">	
				<input type="submit" class="btn btn-success" value="Modificar">
				<a class="btn btn-warning" href="{{URL::route('usuarios')}}" >Regresar</a>
			</div>
		</div>
	</form>
@stop

@section("js")
@stop