@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
	<h2>Registro de Pedido</h2>
@stop

@section("contenido")
<form id="form" autocomplete="off" enctype="multipart/form-data"   method="post"  action="{{URL::route('comprasSave')}}" >
 <input id="token" type="hidden" name="_token" value="{{{ Session::getToken() }}}">
 <input name="csrf_token" type="hidden" value="{{csrf_token()}}">
 
        <fieldset>
          <legend>
            Pedidos
          </legend>
    
    <div class="col-sm-4">
      <div class="form-group">
        <label class="col-sm-2 control-label" style="{{($errors->first('proveedor')) ? 'color:red' : '' }}" for="inputnombrep"> Proveedor </label>
 				<select name="proveedor"  class="form-control">
	            	<option value="">Seleccione un proveedor..</option>
	            	@foreach($proveedores as $proveedor)
	            	<option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
	            	@endforeach
	            </select>              
            </div>
          </div>
    
        <div class="col-sm-4">
         <div class="form-group">    
            <label class="col-sm-5 control-label" style="{{($errors->first('almacen')) ? 'color:red' : '' }}" for="inputnombrep"> Enviar a: </label>
              <select name="almacen"  class="form-control">
                <option value="">Seleccione un almacén..</option>
                @foreach($almacenes as $almacen)
                <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                @endforeach
              </select>              
              </div>
          </div> 
 
      <div class="col-sm-4">
        <div class="form-group">
            <label class="col-sm-2 control-label" style="{{($errors->first('articulo')) ? 'color:red' : '' }}" for="inputnombrep"> Artículo </label>
              	<select name="articulo" class="form-control">
	            	<option value="">Seleccione un articulo..</option>
	            	@foreach($articulos as $articulo)
	            	<option value="{{$articulo->id}}">{{$articulo->nombre}}</option>
	            	@endforeach
	            </select>
           </div>
         </div> 

        <div class="col-sm-4">
          <div class="form-group">
            <label class="col-sm-2 control-label" style="{{($errors->first('descripcion')) ? 'color:red' : '' }}" for="inputnombrep"> Descripción </label>
              	<input type="text" class="form-control" name="descripcion" id="descripcion" >
              </div>
          </div> 

        <div class="col-sm-4">
           <div class="form-group">
            <label class="col-sm-2 control-label" style="{{($errors->first('color')) ? 'color:red' : '' }}" for="inputnombrep"> Color </label>
                <input type="text" class="form-control" name="color" id="color" >
              </div>
          </div> 

      <div class="col-sm-4">
        <div class="form-group">
          <label class="col-sm-7 control-label" style="{{($errors->first('precio_unitario')) ? 'color:red' : '' }}" for="inputnombrep"> Precio Unitario  $</label>
              	<input type="text" class="form-control" name="precio_unitario" id="precio_unitario" value="0" onkeyup="multi();">
            </div> 
        </div> 

        <div class="col-sm-4">
          <div class="form-group">
            <label class="col-sm-2 control-label" style="{{($errors->first('cantidad')) ? 'color:red' : '' }}" for="inputnombrep"> Cantidad </label>
              	<input type="number" max="9999999" min="1"  class="form-control" name="cantidad"  id="cantidad" onkeyup="multi();">
              </div>
          </div> 

      <div class="form-group">
          <div class="col-sm-4">
            <label class="col-sm-5 control-label" style="{{($errors->first('subtotal')) ? 'color:red' : '' }}" for="inputnombrep"> Subtotal $ </label>
              	<input type="text" class="form-control" name="subtotal" id="subtotal" readonly=”readonly” value="0" onkeyup="desc();">
          </div> 
     </div> 

        <div class="col-sm-4">
          <div class="form-group">
            <label class="col-sm-2 control-label" style="{{($errors->first('descuento')) ? 'color:red' : '' }}" for="inputnombrep"> Descuento </label>
              	<input type="text" class="form-control" name="descuento" id="descuento"  onkeyup="desc();">
          </div> 
      </div>

        <div class="col-sm-4">
          <div class="form-group">
            <label class="col-sm-10 control-label" style="{{($errors->first('subtotal_descuento')) ? 'color:red' : '' }}" for="inputnombrep"> SubTotal Con Descuento </label>
              	<input type="text" class="form-control" name="subtotal_descuento" id="subtotal_descuento" readonly=”readonly” value="0">
              </div>
          </div> 

      <div class="col-sm-4">
           <div class="form-group">
            <label class="col-sm-5 control-label" style="{{($errors->first('iva')) ? 'color:red' : '' }}" for="inputnombrep"> IVA $ </label>
                <input type="text" class="form-control" name="iva" id="iva" readonly=”readonly” value="0"  onkeyup="total();" >
          </div> 
      </div>

      <div class="col-sm-4">
          <div class="form-group">
            <label class="col-sm-5 control-label" style="{{($errors->first('total')) ? 'color:red' : '' }}" for="inputnombrep"> Gran Total </label>
              	   <input type="text" class="form-control" name="total" id="total" readonly=”readonly” value="0">
              </div>
          </div> 

       <div class="col-sm-4">   
          <div class="form-group">
            <label class="col-sm-2 control-label" style="{{($errors->first('observaciones')) ? 'color:red' : '' }}" for="inputimagen"> Observaciones </label>
                <textarea class="form-control autosize area-animated" name="observaciones" id="observaciones" data-autosize-on="true" style="overflow: hidden; resize: horizontal; word-wrap: break-word; height: 71px;">
                </textarea>
              </div>
            </div>

        <div class="col-sm-5">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputimagen"> Imágenes </label>
               <span class="btn btn-wide btn-default btn-squared fileinput-button"> <i class="glyphicon glyphicon-plus"> </i> 
                <span> Presionar aquí para seleccionar Imágen... </span>
                  <input id="imgs"  type="file" name="images[]"  id="file2" />                
                </span>
              </div>
          </div> 
        
		  
          <div class="col-md-12">                       
            <div class="form-group">
              <button id="guardar" type="submit" class="btn btn-wide btn-primary pull-right">
                Guardar
              </button>
              <a class="btn btn-warning" href="{{URL::route('compras')}}" >Regresar</a>
            </div>
        </div>

</form>
</fieldset>
		
@stop

@section("js")

<script type="text/javascript">
    
    function sumar()
    {
        var valor1=verificar("costo_unitario");
        var valor2=0.7;
        document.getElementById("precio_unitario").value=parseFloat(valor1)/parseFloat(valor2);
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

     function multi()
    {
        var valor3=verificar("cantidad");
        var valor4=verificar("precio_unitario");
        document.getElementById("subtotal").value=parseFloat(valor3)*parseFloat(valor4);
    }

     function desc()
    {
        var valor5=verificar("subtotal");
        var valor6=verificar("descuento");
        var valor7=16;
        var valor8=((parseFloat(valor5))-(parseFloat(valor6)*(parseFloat(valor5)/100)));
        var valor9=parseFloat(valor7)*(parseFloat(valor8)/100); 
        document.getElementById("subtotal_descuento").value=((parseFloat(valor5))-(parseFloat(valor6)*(parseFloat(valor5)/100)));
        document.getElementById("iva").value=parseFloat(valor7)*(parseFloat(valor8)/100);   
        document.getElementById("total").value=parseFloat(valor8)+parseFloat(valor9);   

     }
 
      



    </script>
@stop