@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
	<h2>Editar Prospecto</h2>
@stop

@section("contenido")
	<form action="{{URL::route('prospectosEditar')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$prospectos->id}}">

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Nombre  Completo
	                {{($errors->first("nombre")) ? $errors->first("nombre")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="nombre" value="{{(Input::old('nombre')) ? Input::old('nombre') : $prospectos->nombre}}" class="form-control" placeholder="Nombre">
			</div>
		</div>

		<div class="col-md-4" >
				<div class="form-group">
					<label for="">Género
	                {{($errors->first("genero")) ? $errors->first("genero")." <span class='symbol required'></span>": ''}}
	                </label>
					<select type="text" name="genero"  class="form-control" >
						<option hidden="0" value="{{(Input::old('genero')) ? Input::old('genero') : $prospectos->genero}}">{{$prospectos->genero}}</option>
						<option value="Femenino">Femenino</option>
						<option value="Masculino">Masculino</option>
					</select>
				</div>
			</div>

		<div class="col-md-4" >
				<div class="form-group">
					<label for="">Telefono (10 dígitos)
	                {{($errors->first("tlf")) ? $errors->first("tlf")." <span class='symbol required'></span>": ''}}
	                </label>
				<input type="text" name="telefono" value="{{(Input::old('telefono')) ? Input::old('telefono') : $prospectos->telefono}}" class="form-control" placeholder="Teléfono">
				</div>
			</div>

		<div class="col-md-4" >
				<div class="form-group">
					<label for="">Compañia 
	                {{($errors->first("compania")) ? $errors->first("compania")." <span class='symbol required'></span>": ''}}
	                </label>
				<input type="text" name="compania" value="{{(Input::old('compania')) ? Input::old('compania') : $prospectos->compania}}" class="form-control" placeholder="Compañia">
				</div>
			</div>

			<div class="col-md-4" >
				<div class="form-group">
					<label for="">Puesto 
	                {{($errors->first("puesto")) ? $errors->first("puesto")." <span class='symbol required'></span>": ''}}
	                </label>
				<input type="text" name="puesto" value="{{(Input::old('puesto')) ? Input::old('puesto') : $prospectos->puesto}}" class="form-control" placeholder="Puesto">
				</div>
			</div>

			<div class="col-md-4" >
				<div class="form-group">
					<label for="">E-mail 
	                {{($errors->first("mail")) ? $errors->first("mail")." <span class='symbol required'></span>": ''}}
	                </label>
				<input type="text" name="email" value="{{(Input::old('email')) ? Input::old('email') : $prospectos->email}}" class="form-control" placeholder="E-mail">
				</div>
			</div>

		<div class="col-md-12" >
			<div class="form-group">	
				<input type="submit" class="btn btn-success btn-wide pull-right" value="Modificar">
				<a class="btn  btn-wide btn-warning pull-left" href="{{URL::route('prospectos')}}" >Regresar</a>
			</div>
		</div>
	</form>
@stop

@section("js")
@stop