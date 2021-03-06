@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
	<h2>Registro de clientes</h2>
@stop

@section("contenido")
	<form action="{{URL::route('clientesSave')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">


 <div class="container-fluid container-fullw bg-white">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>
            Clientes
          </legend>


          <div class="col-md-4" >
		<div class="form-group">
				<label for="">Empresa 
				 {{($errors->first("nombre")) ? $errors->first("nombre")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="nombre" value="{{Input::old('nombre')}}" class="form-control" id="inputSeleccionado" class="form-control" placeholder="Ingresar Nombre">
			</div>
		</div>
		
		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Persona Contacto 
	                {{($errors->first("contacto")) ? $errors->first("contacto")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="contacto" value="{{Input::old('contacto')}}" class="form-control" placeholder="Ingresar Persona de Contacto">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">RFC
	                {{($errors->first("rfc")) ? $errors->first("rfc")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="rfc" value="{{Input::old('rfc')}}" class="form-control" placeholder="Ingresar RFC">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Calle 
	                {{($errors->first("calle")) ? $errors->first("calle")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="calle" value="{{Input::old('calle')}}" class="form-control" placeholder="Ingresar Calle">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Número Exterior 
	                {{($errors->first("numexterior")) ? $errors->first("numexterior")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="numexterior" value="{{Input::old('numexterior')}}" class="form-control" placeholder="Ingresar Número Exterior">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Número Interior 
	                {{($errors->first("numinterior")) ? $errors->first("numinterior")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="numinterior" value="{{Input::old('numinterior')}}" class="form-control" placeholder="Ingresar Número Interior">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Colonia 
	                {{($errors->first("colonia")) ? $errors->first("colonia")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="colonia" value="{{Input::old('colonia')}}" class="form-control" placeholder="Ingresar Colonia">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">C.P. 
	                {{($errors->first("cp")) ? $errors->first("cp")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="number" max="999999" min="0" name="cp" value="{{Input::old('cp')}}" class="form-control" placeholder="Ingresar  C.P.">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Municipio 
	                {{($errors->first("municipio")) ? $errors->first("municipio")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="municipio" value="{{Input::old('municipio')}}" class="form-control" placeholder="Ingresar Municipio">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Pais 
	                {{($errors->first("pais")) ? $errors->first("pais")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="pais" value="{{Input::old('pais')}}" class="form-control" placeholder="Ingresar Pais">
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

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Teléfono (10 dígitos)
	                {{($errors->first("telefono")) ? $errors->first("telefono")." <span class='symbol required'></span>": ''}}
	            </label>
	            <div class="input-group">
	            <span class="input-group-addon"> <i class="fa fa-phone"></i> </span>
				<input   id="form-field-mask-2" type="text" name="telefono" value="{{Input::old('telefono')}}" maxlength="10" min="10" max="9999999999" class="form-control input-mask-phone" placeholder="Ingresar Teléfono">
			    </div>
			</div>
		</div>

	

		<div class="col-md-12" >
			<div class="form-group">	
				<input type="submit" class="btn btn-success btn-wide pull-right" value="Guardar">
				<a class="btn btn-wide btn-warning pull-left" href="{{URL::route('clientes')}}" >Regresar</a>
			</div>
		</div>
	</fieldset>
	</div>
  </div>
</div>
	</form>
@stop

@section("js")
@stop