@extends ('dashboard.layouts.default')

@section ('title')
  Registro de Articulos
@stop
@section ('css')
@stop

@section('pagina')
  <h2>Listado de Articulos</h2>

@stop

@section ('contenido')
	<!---alert mensajes --->
    @if(Session::has('msg'))
    <div class="alert alert-{{ Session::get('class') }}">
      <button type="button" class="close" data-dismiss="alert">
        <i class="icon-remove"></i>
      </button>
      {{ Session::get('msg')}}
      <br/>
    </div>
    @endif
    
    <div class="alert alert-error" id="alert" style="display:none">
      <button type="button" class="close" data-dismiss="alert">
        <i class="icon-remove"></i>
      </button>
        Los cambios no fueron realizados, intente de nuevo
      <br/>
    </div>
    <!---/.alert mensajes -->

<fieldset>
     <!-- <a href="{{URL::route('create.productos')}}" class="btn btn-success"><i class="fa fa-plus"></i> Actualizar</a>  -->
     <span id="btn_actualizar"><a href="javascript:void(0)" onclick="actualizar_data_api()" class="btn btn-success"><i class="fa fa-plus"></i> Actualizar</a></span> 
  </fieldset>
  <style>
  	.link_clean{
  		color: #585858;
  		cursor: pointer;
  	}
  	.link_clean:hover{
  		color: black;
  	}

  </style>
    <div id="load_data_gif" style="display: none"><img src="../public/assets/images/load_mini.gif"> <b>25%</b> Realizando actualización... Esto puede tardar varios minutos.</div>

    <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">

    <div id="conten_tabla">

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" align="center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Articulo</h4>
          </div>
          <div class="modal-body col-xs-12">
	          <div class="col-xs-4 col"><img src="" id="imagen" width="100%"></div>
	          <div class="col-xs-8 col">
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

	   <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		   <thead>
		   <tr>
			   <th>Referencia</th>
			   <!--<th>Imagen</th>-->
			   <th>Nombre</th>
			   <th>Proveedor</th>			
		   </tr>
		   </thead>
		   <tbody>


	    @foreach($articulos as $articulo)
	 	   <tr onclick="mostrar_detalles({{$articulo->id}}); return false;">
	 	   	   <td >{{$articulo->id}}</td>
	 	   	   <!--<td>$articulo->imagen</td>-->
	 		   <!--<td align="center"><img width="85" height="60" src="{{$articulo->imagen}}" /></td>-->
	 		   <td><a href="#" class="link_clean" >{{$articulo->nombre}}</a></td>
	 		   <td id="proveedor{{$articulo->id}}">{{$articulo->Proveedores->nombre}}</td>
	 	   </tr>
	    @endforeach
	     </tbody>		
	   </table>
	</div>
@stop
@section('js')

</script>
<script>

function mostrar_detalles(id){
	var url = "articulos/ver";
	var prove = "#proveedor"+id;
	var proveedor = $(prove).html();

	$.ajax({
        url: url,
        type: 'get',
        global: false,
        data: {id: id},
        dataType: 'json',
        error: function (data) {
            console.log(data);
 			return false;
        },
     	success: function(data) {
     		if(data['success']) {
	 			//console.log(data.nombre);
	 		    $(data.records).each(function(i,item){
	 		     	$("#myModalLabel").html(item.nombre);
	 		        $("#Nombre").html(item.nombre);
	 		        $("#Referencia").html(item.id);
	 		        $("#Descripcion").html(item.descripcion);
	 		        $("#Proveedor").html(proveedor);
	 		        $("#imagen").attr('src', item.imagen);
	 				$("#myModal").modal();
	 		    });
     		}
     	}
     });
}


 var posicion = 0;
 var posicion_final = 12;

	function actualizar_data_api(){
		mostrar_loader();
		ocultar_tabla();
		btn_disabled();
		posicion = 11;
		get_data_update(9999,'','',0);
 }


 function mostrar_loader(){
   document.getElementById('load_data_gif').style.display = '';
 }

 function ocultar_loader(){
 	document.getElementById('load_data_gif').style.display = 'none';
 }

 function mostrar_tabla(){
   document.getElementById('conten_tabla').style.display = '';
 }

 function ocultar_tabla(){
 	document.getElementById('conten_tabla').style.display = 'none';
 }
 function btn_enabled(){
   document.getElementById('btn_actualizar').innerHTML = '<a href="javascript:void(0)" onclick="actualizar_data_api()" class="btn btn-success"><i class="fa fa-plus"></i> Actualizar</a>';
 }

 function btn_disabled(){
 	document.getElementById('btn_actualizar').innerHTML = '<a href="javascript:void(0)"  class="btn btn-success"><i class="fa fa-plus"></i> Actualizar</a>';
 }
 //

 function get_data_update(total_registros,inicio_limit,fin_limit,posicions){

 	var host_app = window.location.host;
	var path_host = window.location.pathname;
	var path_new =path_host.split('articulos'); 

	if(inicio_limit=='' || inicio_limit==0){
		var limit_inicio = 1;
	}else{
		var limit_inicio = inicio_limit;
	}

	if(fin_limit=='' || fin_limit==0){
		var limit_fin = 6000;
	}else{
		var limit_fin = fin_limit;
	}
	if(total_registros==''){
		total_registros=0;
	}
	if(posicions!=0){
	var porcentaje = (parseInt(posicion)*100)/posicions;
	porcentaje=(porcentaje).toFixed();
}else{
	var porcentaje = 0;
}
 
 	var dn=host_app+path_new[0]+'articulos/create2/';
 	//var argumentos = ''+total_registros+'/'+limit_inicio+'/'+limit_fin;
 	var argumentos = '?total_registros='+total_registros+'&limit_inicio='+limit_inicio+'&limit_fin='+limit_fin+'&posicion='+posicions;
 	ajax_url='{{URL::route('create2.productos')}}'+argumentos;

 	console.log(ajax_url);
    
 	$.get(ajax_url,function(data){
 		if(total_registros==0){
    	   mensaje_load ='<img src="../public/assets/images/load_mini.gif"> Obteniendo total de registros...';
        }else{
           mensaje_load ='<img src="../public/assets/images/load_mini.gif"> <b>'+porcentaje+'%</b> Realizando actualización... Esto puede tardar varios minutos.';
        }
    document.getElementById('load_data_gif').innerHTML = mensaje_load;
           console.log("Posicion: "+posicion)
 		if(data.total_registros>0 && posicion==1) 
 		 {
 		 	posicion =parseInt(posicion) + 1;
            posicion_final =data.posicion;
            //get_data_update(data.total_registros,data.inicio_limit,data.fin_limit,posicion_final);
            setTimeout( "get_data_update("+data.total_registros+","+data.inicio_limit+","+data.fin_limit+","+posicion_final+");", 1000 );

           
 		 }else if(posicion > 1){
 		 	console.log("poscion inicial: "+posicion+" - posicion final: "+posicion_final);
 		 	if(posicion<=posicion_final){
 		 		posicion = parseInt(posicion) + 1;
 		 		desde = parseInt(data.fin_limit) + 1;
 		 		hasta = parseInt(data.fin_limit) + 500;
 		 		console.log("desde "+desde+" hasta "+hasta)

 		 		//get_data_update(data.total_registros,desde,hasta,posicion_final);
 		 		//setTimeout( "get_data_update("+data.total_registros+","+desde+","+hasta+","+posicion_final+");", 20000 );
 		 		setTimeout( "enlace_peticion("+data.total_registros+","+desde+","+hasta+","+posicion_final+");", 1000 );

 		 	}else{
 		 		btn_enabled();
 		 		mostrar_tabla();
 		 		ocultar_loader();
 		 		document.getElementById('load_data_gif').innerHTML = " Operación finalizada... Actualizando tabla!";
 		 		setTimeout( "recarga_pagina()", 2000 ); 
 		 	}

 		 }
 		  
 	});
 
 }
function enlace_peticion(total_registros,desde,hasta,posicion_final){
	get_data_update(total_registros,desde,hasta,posicion_final);
}

function recarga_pagina(){
	location.reload(true);
}
</script>

@stop