@extends("dashboard.layouts.default")

@section("title")
	Editar almacén
@stop

@section("css")
@stop

@section("pagina")
	<h2>Editar almacén</h2>
@stop

@section("contenido")
	<form action="{{URL::route('almacenEditar')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$almacen->id}}">

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Nombre 
	                {{($errors->first("nombre")) ? $errors->first("nombre")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="nombre" value="{{(Input::old('nombre')) ? Input::old('nombre') : $almacen->nombre}}" class="form-control" placeholder="Nombre">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Persona Contacto 
	                {{($errors->first("contacto")) ? $errors->first("contacto")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="contacto" value="{{(Input::old('contacto')) ? Input::old('contacto') : $almacen->persona_contacto}}" class="form-control" placeholder="Persona contacto">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">RFC
	                {{($errors->first("rfc")) ? $errors->first("rfc")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="rfc" value="{{(Input::old('rfc')) ? Input::old('rfc') : $almacen->rfc}}" class="form-control" placeholder="RFC">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Calle 
	                {{($errors->first("calle")) ? $errors->first("calle")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="calle" value="{{(Input::old('calle')) ? Input::old('calle') : $almacen->calle}}" class="form-control" placeholder="Calle">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Número Exterior 
	                {{($errors->first("numexterior")) ? $errors->first("numexterior")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="numexterior" value="{{(Input::old('numexterior')) ? Input::old('numexterior') : $almacen->numexterior}}" class="form-control" placeholder="Número Exterior">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Número Interior 
	                {{($errors->first("numinterior")) ? $errors->first("numinterior")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="numinterior" value="{{(Input::old('numinterior')) ? Input::old('numinterior') : $almacen->numinterior}}" class="form-control" placeholder="Número Interior">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Colonia 
	                {{($errors->first("colonia")) ? $errors->first("colonia")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="colonia" value="{{(Input::old('colonia')) ? Input::old('colonia') : $almacen->colonia}}" class="form-control" placeholder="Colonia">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">C.P. 
	                {{($errors->first("cp")) ? $errors->first("cp")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="cp" value="{{(Input::old('cp')) ? Input::old('cp') : $almacen->cp}}" class="form-control" placeholder="C.P.">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Municipio 
	                {{($errors->first("municipio")) ? $errors->first("municipio")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="municipio" value="{{(Input::old('municipio')) ? Input::old('municipio') : $almacen->municipio}}" class="form-control" placeholder="Municipio">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Pais 
	                {{($errors->first("pais")) ? $errors->first("pais")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="pais" value="{{(Input::old('pais')) ? Input::old('pais') : $almacen->pais}}" class="form-control" placeholder="Pais">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">E-mail 
	                {{($errors->first("email")) ? $errors->first("email")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="email" value="{{(Input::old('email')) ? Input::old('email') : $almacen->email}}" class="form-control" placeholder="E-mail">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Teléfono 
	                {{($errors->first("telefono")) ? $errors->first("telefono")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="telefono" value="{{(Input::old('telefono')) ? Input::old('telefono') : $almacen->telefono}}" maxlength="10" min="10" max="9999999999" class="form-control" placeholder="Teléfono">
			</div>
		</div>

		<div class="col-md-10" >
			<div class="form-group">	
				<input type="submit" class="btn btn-success" value="Modificar">
				<a class="btn btn-warning" href="{{URL::route('almacenLista')}}" >Regresar</a>
			</div>
		</div>
	</form>
@stop

@section("js")
@stop