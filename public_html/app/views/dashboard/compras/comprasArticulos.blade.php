@extends("dashboard.layouts.default")

@section("title")
	Articulos compra
@stop

@section("css")
@stop

@section("pagina")
	Articulos compra
@stop

@section("contenido")
	<input type="hidden" id="rapaz" value="rapaz">
	<input type="hidden" id="url" value="{{URL::route('asignarAlmacen')}}">
	<input type="hidden" id="token"   value="{{csrf_token()}}">
	<input type="hidden" id="id"  value="{{$id}}">
	<div style="display:none;" class="progress progress-striped active" id="barra">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> Procesando...
        </div>
    </div>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header" align="center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Articulo</h4>
              </div>
              <div class="modal-body col-xs-12">
	      	    <table class="table table-hover table-condensed table-striped">
                  <tr>
                    <td>Nombre</td>
                    <td width="70%"><strong id="Nombre"></strong></td>
                  </tr>
                  <tr>
                    <td>Referencia </td>
                    <td width="70%"><strong id="Referencia"></strong></td>
                  </tr>
                  <tr>
                    <td>Descripcion</td>
                    <td width="70%"><strong id="Descripcion"></strong></td>
                  </tr>
                  <tr>
                    <td>Proveedor</td>
                    <td width="70%"><strongd id="Proveedor"></strong></td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>




	<div class="col-ms-12" id="div-almacenes" style="display:none;">
	<form id="form-almacenes" data-url="{{URL::route('almacenCrearAjax')}}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="form-group">
			<div class="col-md-4" >
				<label for="">Almacen 

	                {{($errors->first("nombre")) ? $errors->first("nombre")." <span class='symbol required'></span>": ''}}
	            </label>
				<input type="text" name="nombre" valus="{{Input::old('nombre')}}" class="form-control" id="inputSeleccionado" class="form-control" placeholder="Ingresar Nombre">
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
				<input type="email" name="email" value="{{Input::old('email')}}" class="form-control" placeholder="Ingresar E-mail">
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

		<div class="col-md-10" >
			<div class="form-group">	
				<a href="#" id="guardar" class="btn btn-success">Guardar</a>
			</div>
		</div>
	</form>
	</div>


    <div class="alert alert-danger" style="display:none;">Seleccione un almacen...</div>
	
	<div class="col-md-12">
		Almacén: 
	<select name="" id="almacen" onclick="capturar();">
		<option value="Seleccione un almacen">Seleccione un almacén... </option>
		@foreach($almacenes as $almacen)
			@if($almacen->id == $cc->almacen_id)
				<option selected value="{{$almacen->id}}">{{$almacen->nombre}}</option>
			@else
				<option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
			@endif
		@endforeach
	</select>
	<a href="#" id="asignar" class="label label-primary">Asignar almacén</a>
	<a href="#" id="add-almacenes" class="label label-primary">Registrar almacen</a>
	<label id="almacen_asignado"></label>
	</div>
	<table class="table">
		<tr>
			<th>
				Codigo
			</th>
			<th>
				Proveedor
			</th>
			<th>
				Tipo impresión
			</th>
			<th>
				Articulo
			</th>
			<th>
				Imagen
			</th>
			<th>
				Cantidad
			</th>
			<th>
				Costo Unitario
			</th>
			<th>
				Costo de Impresión
			</th>
			<th>
				Total
			</th>
			<th>
				Opciones
			</th>
		</tr>
		<?php $total = 0; ?>
		@foreach($articulos as $a)
		<tr>
			<td>
				{{$a->id}}
			</td>
			<td>
				{{$proveedor->nombre}}
			</td>
			<td>
				{{$a->tipoimpresion}} <br>
				@if($a->tipoimpresion == "Serigrafia" || $a->tipoimpresion == "Tempografia" || $a->tipoimpresion == "Sand Blast")
					Tintas: {{$a->infoimpresion}}
				@endif
				@if($a->tipoimpresion == "Bordado")
					Hilos: {{$a->infoimpresion}}
				@endif
			</td>
			<td>
				{{$a->nombre}}
			</td>
			<td>
				<img src="../{{$a->imagen}}" width="50px" height="50px" >
			</td>
			<td>
				{{$a->cantidad}}
			</td>
			<td>
				$ {{number_format($a->costo_unitario,2,".",",")}}
			</td>
			<td>
				$ {{number_format($a->costoimpresion,2,".",",")}}
			</td>
			<td>
				$ {{number_format($a->precio_unitario*$a->cantidad,2,".",",")}}
			</td>
			<td>
				<!--<a href="{{URL::route('compraEditarForm')}}/{{$a->id}}" class="label label-warning">
					<i class="fa fa-pencil"></i>
				</a>-->
				<a href="#" onclick="editarform({{$a->id}});" class="label label-warning">
					<i class="fa fa-pencil"></i>
				</a>
			</td>
		</tr>
		<?php $total += ($a->precio_unitario*$a->cantidad); ?>
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>$ {{number_format($total,2,".",",")}}</td>
			<td></td>
		</tr>
	</table>
	<a href="{{URL::route('comprasMostrarForm')}}/{{$id}}" class="btn btn-primary pull-right" onclick="return myFunction()">Comprar</a>

	
@stop

@section("js")
	<script>
	var almacen_seleccionado;
	var valor;

	function capturar(){
		var nuevo_valor = document.getElementById("almacen").value;
		if(valor != "Seleccione un almacen" || nuevo_valor != "Seleccione un almacen" ){
			valor = nuevo_valor;
			if(nuevo_valor != almacen_seleccionado){
				$("#almacen").removeAttr('style');
				$("#almacen").css({'border':'#gray 1px solid'});
				$("#almacen_asignado").html('');
				return true;
			} else {
			  $("#almacen").css({'border':'#81F781 1px solid'});
			  $("#almacen_asignado").css({'color':'green'});
			  $("#almacen_asignado").css({'font-size':'12px'});
			  $("#almacen_asignado").html('Almacén asignado');
			  return false
			}
			return false;
		}

	}


	function editarform(id){
		alert('Esta es' + id);
	}

		$(document).ready(function(){
			estado = 1;

			

			$("#asignar").click(function(){
				estado = 2;
				if(capturar()){
					$("#barra").show();
					$.ajax({
						url: $("#url").val(),
						type: "post",
						data: {
							_token: $("#token").val(),
							almacen: $("#almacen").val(),
							id: $("#id").val()
						},
						dataType: "json",
						success: function(data) {
						  console.log(data.estado);						  
						  $("#almacen").css({'border':'#81F781 1px solid'});
						  $("#almacen_asignado").css({'color':'green'});
						  $("#almacen_asignado").css({'font-size':'12px'});
						  $("#almacen_asignado").html('Almacén asignado');
						  almacen_seleccionado = valor;
						  $("#barra").hide();
						}
					});
				}
			});
			$("#add-almacenes").click(function(){
				$("#div-almacenes").show();
			});
			$("#guardar").click(function(){
				var flag = $("#rapaz").val();
				var nombrealmacen = $("#inputSeleccionado").val();
				var s = $("#form-almacenes").serializeArray();	
				var status = true;
				//console.log(s);
				if(flag == 'rapaz'){
					if(nombrealmacen != ''){
						status = true;
					} else {
						$("#inputSeleccionado").css({"border":"red 1px solid"});
						status = false;
					}
					console.log(flag);
				} else {
					for(var i in s) {
						if(s[i].value ==  ""){
							$("input[name='"+s[i].name+"']").css({"border":"red 1px solid"});
							status = false;
							console.log(s[i].name);
						} else {
							$("input[name='"+s[i].name+"']").css({"border":"1px solid"});
						}
					}
				}
				if(status != false) {
					$.ajax({
						url: $("#form-almacenes").attr("data-url"),
						type: "post",
						data:$("#form-almacenes").serialize(),
						dataType: "json",
						success: function(data) {
							var x = $("#form-almacenes").serializeArray();
							for(var q in x){
								$("input[name='"+x[q].name+"']").val("");
							}
							$("#div-almacenes").hide();
							var opt = "<option>Seleccione almacén</option>";
							for (var z in data.a) {
								opt += "<option value='"+data.a[z].id+"'>"+data.a[z].nombre+"</option>";
							}
							$("#almacen").html(opt);
						}
					});
				}

			});
			
 		});



		function myFunction() 
		{
	    	if(estado == 1) {
	    		$(".alert").show();
	    		return false;
	    	} else {
	    		$(".alert").hide();
	    	}
	     	var x = confirm("Verificar compra");
	     	return x;
		}
	</script>
@stop