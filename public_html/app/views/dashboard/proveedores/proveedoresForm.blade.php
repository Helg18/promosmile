@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
	<h2>Registro de proveedores</h2>
@stop

@section("contenido")
	<form action="{{URL::route('proveedoresSave')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="form-group">
			<div class="col-md-4" >
				<label for="">Nombre 

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
				<input type="number" name="cp" value="{{Input::old('cp')}}" class="form-control" placeholder="Ingresar  C.P.">
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
				<input type="email" name="email[]" value="{{Input::old('email')}}" class="form-control" placeholder="Ingresar E-mail">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Teléfono (10 dígitos)
	                {{($errors->first("telefono")) ? $errors->first("telefono")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="telefono" value="{{Input::old('telefono')}}" maxlength="10" min="10" max="9999999999" class="form-control" placeholder="Ingresar Teléfono">
			</div>
		</div>

		<div class="col-md-4" >
			<div class="form-group">
				<label for="">Descuento que aplica
	                {{($errors->first("descuento")) ? $errors->first("descuento")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="descuento" value="{{Input::old('descuento')}}" class="form-control" placeholder="Ingresar descuento">
			</div>
		</div>
		<span id="emails"></span>
		<div class="col-md-10" >
			<div class="form-group">	
				<input type="submit" class="btn btn-success" value="Guardar">
				<a class="btn btn-warning" href="{{URL::route('proveedores')}}" >Regresar</a>
				<a class="btn btn-primary" id="add-email" href="#" >Agregar E-mail</a>
			</div>
		</div>
	</form>
@stop

@section("js")
	<script type="text/javascript">
		$(document).ready(function(){
		  var div = '<div class="col-md-4" > \
			<div class="form-group"> \
				<label for="">E-mail </label> \
				<input type="email" name="email[]" value="{{Input::old("email")}}" class="form-control"placeholder="Ingresar E-mail"> \
				</div> \
			</div>';
			$("#add-email").click(function(){
				$("#emails").append(div);
			});
		});
	</script>
@stop