@extends("dashboard.layouts.default")

@section("title")
	Prospectos
@stop

@section("css")
@stop

@section("pagina")
	<h2>Prospectos</h2>
@stop

@section("contenido")

 
		<form action="{{URL::route('prospectosSave')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<fieldset>
			<div class="col-md-4" >
				<div class="form-group">
					<label for="">Nombre Completo
	                {{($errors->first("nombre")) ? $errors->first("nombre")." <span class='symbol required'></span>": ''}}
	                </label>
					<input type="text" name="nombre" value="{{Input::old('nombre')}}" class="form-control" placeholder="Ingresar Nombre Completo">
				</div>
			</div>

			<div class="col-md-4" >
				<div class="form-group">
					<label for="">Género
	                {{($errors->first("genero")) ? $errors->first("genero")." <span class='symbol required'></span>": ''}}
	                </label>
					<select type="text" name="genero" value="{{Input::old('genero')}}" class="form-control" >
						<option hidden="0">Seleccione el genero.</option>
						<option value="Femenino">Femenino</option>
						<option value="Masculino">Masculino</option>
					</select>
				</div>
			</div>


			<div class="col-md-4" >
				<div class="form-group">
					<label for="">Telefono (10 dígitos)
	                {{($errors->first("telefono")) ? $errors->first("telefono")." <span class='symbol required'></span>": ''}}
	                </label>
					<input type="text"  name="telefono" value="{{Input::old('telefono')}}"  maxlength="10" min="10" max="9999999999"class="form-control" placeholder="Ingresar Número de Teléfono">
				</div>
			</div>

			<div class="col-md-4" >
				<div class="form-group">
					<label for="">Compañia 
	                {{($errors->first("compania")) ? $errors->first("compania")." <span class='symbol required'></span>": ''}}
	                </label>
					<input type="text"  name="compania" value="{{Input::old('compania')}}" class="form-control" placeholder="Ingresar Nombre de La Compañía">
				</div>
			</div>

			<div class="col-md-4" >
				<div class="form-group">
					<label for="">Puesto 
	                {{($errors->first("puesto")) ? $errors->first("puesto")." <span class='symbol required'></span>": ''}}
	                </label>
					<input type="text"  name="puesto" value="{{Input::old('puesto')}}" class="form-control" placeholder="Ingresar Puesto">
				</div>
			</div>

			<div class="col-md-4" >
				<div class="form-group">
					<label for="">E-mail 
	                {{($errors->first("email")) ? $errors->first("email")." <span class='symbol required'></span>": ''}}
	                </label>
					<input type="email" name="email" value="{{Input::old('email')}}" class="form-control" placeholder="Ingresar E-mail">
				</div>
			</div>

			<div class="col-md-12" >
				<div class="form-group">
					<a class="btn  btn-wide btn-warning pull-left" href="{{URL::route('prospectos')}}" >Regresar</a>
					<input type="submit" class="btn btn-wide btn-success pull-right" value="Enviar">
					
				</div>
			</div>
		</fieldset>
	</form>
@stop

@section("js")
@stop