@extends ('dashboard.layouts.default')

@section ('title')
  Editar Articulo
@stop
@section ('css')
@stop

@section('pagina')
  <h2>Editar Articulo</h2>
@stop

@section ('contenido')

       
            <!--PAGE CONTENT BEGINS-->

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
      @if ($errors->has())
        <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
              </button>
        @if ($errors->has('images')) ¡Atención! Solo se permiten archivos de tipo: jpg,gif,jpeg,png.<br> @endif               
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

<!-- START FORM -->

<form id="form" autocomplete="off"  enctype="multipart/form-data" method="post" action="{{ URL::to('articulos/'.$productos->id.'/edit/') }}" class="form-horizontal">
 <input id="token" type="hidden" name="_token" value="{{{ Session::getToken() }}}">
 <input name="csrf_token" type="hidden" value="{{csrf_token()}}">
 
  <div class="container-fluid container-fullw bg-white">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>
            Articulo
          </legend>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Nombre </label>
              <div class="col-sm-10">
                <input type="text" value="{{$productos->nombre}}" placeholder="Nombre del Producto" name="nombre" class="form-control">
              </div>
          </div> 

          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Descripción </label>
              <div class="col-sm-10">
                <input type="text" value="{{$productos->descripcion}}" placeholder="Nombre del Producto" name="descripcion" class="form-control">
              </div>
          </div> 

          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Proveedor </label>
              <div class="col-sm-10">
              <select name="proveedor" value="{{Input::old('proveedor')}}" class="form-control" placeholder="Ingresar Proveedor">
                @foreach(Proveedor::where('id','=',$productos->proveedor)->get() as $proveedor)
                <option value="{{$productos->proveedor}}" hidden="0">{{$proveedor->nombre}}</option>
                @endforeach
                  @foreach($proveedores as $prov)
                    <option value="{{$prov->id}}">{{$prov->nombre}}</option>
                  @endforeach
              </select>              </div>
          </div> 


           
		<div class="form-group">
			<input name="new_sku" id="new_sku" type="hidden" value="0">
            <label class="col-sm-2 control-label"></label>
			<div class="col-sm-4">
			<div id="content_sku" class="form-inline" style="margin-top:-6%" >
			</div>		
			</div>			   
        </div> 
		  
          <div class="col-md-12">                       
            <div class="form-group">
              <a href="{{URL::route('see.productos')}}" class="btn btn-wide btn-warning pull-left">Regresar</a>
              
              <button style="margin-left: 10px;" type="submit" class="btn btn-wide btn-primary hidden-print pull-right">
                Actualizar
              </button>
              <a href="{{URL::route('editImage')}}/{{$productos->id}}" class="btn btn-success pull-right">Editar Imagenes</a> 

            </div>
          </div>

        </fieldset>
      </div>
    </div>
  </div>
</form>
<!-- end: FORM -->


@stop
@section('js')
<script src="{{asset('assets/js/productos.js')}}"></script>

<script type="text/javascript">
    
    function sumar()
    {
        var valor1=verificar("precio");
        var valor2=verificar("costo_envio");
        document.getElementById("total").value=parseFloat(valor1)+parseFloat(valor2);
    }
 
    function verificar(id)
    {
        var obj=document.getElementById(id);
        if(obj.value=="")
            value="0";
        else
            value=obj.value;
        if(value,1)
        {
            // marcamos como erroneo
            obj.style.borderColor="#808080";
            return value;
        }else{
            // marcamos como erroneo
            obj.style.borderColor="#f00";
            return 0;
        }
    }

	function addSku() { 	
		
		var num_sku 	= document.getElementById("count_sku").value;
		
		var i_sku 		= document.getElementById("i_sku").value;
		
		var cantidad 	= document.getElementById("cantidad").value;
		
		var container 	= document.getElementById('content_sku');
		
		container.innerHTML="";
		
		if(num_sku == cantidad ){
			document.getElementById("new_sku").value = 0 ;
		}else{
			document.getElementById("new_sku").value = 1;
		}
		
		for($i=i_sku; $i<cantidad; $i++){
			
			i_sku++;
			
				var input  					= document.createElement("input");			
					input.type				= 'text';			
					input.name				= 'sku[]';
					input.className			= 'form-control';
					input.style.marginTop	= "2%";
					input.placeholder		= 'SKU - '+i_sku;							

			container.appendChild(input);		
		}
			
	}

	function delete_sku(sku)
    {
        document.getElementById("sku_delete"+sku).value=1;
		$("#sku"+sku).hide();
		
		var cantidad = $("#cantidad").val();
		var sku		 = $("#count_sku").val();
		
		if(cantidad > 1 ){
			document.getElementById("cantidad").value= cantidad -	1;
			document.getElementById("count_sku").value = sku - 1;
			document.getElementById("i_sku").value = sku - 1;
		}
		
		if(cantidad == 1){
			
			document.getElementById("count_sku").value = 0;
			
			var container = document.getElementById('content_sku2');
			
				var input  					= document.createElement("input");			
					input.type				= 'text';			
					input.name				= 'sku[]';
					input.className			= 'form-control';
					input.style.marginTop	= "2%";
					input.placeholder		= 'SKU - 1';							

					document.getElementById("new_sku").value = 1;
					
			container.appendChild(input);
		}
			
    }
	
</script>

@stop