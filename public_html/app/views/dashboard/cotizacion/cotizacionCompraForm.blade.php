@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
	<h2>Registro de Compra</h2>
@stop

@section("contenido")

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


<form id="form" autocomplete="off" enctype="multipart/form-data"   method="post"  action="{{URL::route('comprasSaveCotizacion')}}" class="form-horizontal">
 
 <input id="token" type="hidden" name="_token" value="{{{ Session::getToken() }}}">
 <input name="csrf_token" type="hidden" value="{{csrf_token()}}">
 <input type="hidden" name="id" value="{{$cotizacion->id}}">
  <div class="container-fluid container-fullw bg-white">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>
            Compras
          </legend>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Proveedor </label>
              <div class="col-sm-7">
 		          <input type="hidden" name="id" value="{{$cotizacion->id}}">
              <input type="hidden" name="proveedor" value="{{$proveedores->id}}">
              <input type="text" readonly="readonly" name="" class="form-control" value="{{$proveedores->nombre}}">
              </div>
          </div> 

           <div class="form-group">
            <label class="col-sm-2 control-label" style="{{($errors->first('almacen')) ? 'color:red' : '' }}" for="inputnombrep"> Enviar a </label>
              <div class="col-sm-7">
              <select name="almacen"  class="form-control">
                <option value="">Seleccione un almacén..</option>
                @foreach($almacenes as $almacen)
                  @if($almacen->id == $cotizacion->almacen_id)
                    <option value="{{$almacen->id}}" selected>{{$almacen->nombre}}</option>
                  @endif
                    <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                @endforeach
              </select>              
              </div>
          </div> 

            <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep" > Articulo </label>
              <div class="col-sm-7">
                <select required name="articulo"  class="form-control" readonly=”readonly” >
                <option readonly=”readonly”  value="{{$articulos->id}}">{{$articulos->nombre}}</option>
           
              </select>              </div>
          </div> 
<div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Descripción </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="descripcion" id="descripcion" readonly=”readonly” value="{{$cotizacion->descripcion}}" >
              </div>
          </div> 

           <div class="form-group">
            <label class="col-sm-2 control-label" style="{{($errors->first('color')) ? 'color:red' : '' }}" for="inputnombrep"> Color </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="color" id="color" >
              </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Costo Unitario </label>
              <div class="col-sm-7">
                <div class="input-group">
                <input type="text" class="form-control" name="costo_unitario" id="costo_unitario"  value="{{$cotizacion->precio_unitario}}" onkeyup="multi();">
                  <span class="input-group-addon">$</span>
              </div>
          </div> 
    </div> 


          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Cantidad </label>
              <div class="col-sm-7">
                <input type="number" max="9999999" min="1"  class="form-control" name="cantidad"  id="cantidad" value="{{$cotizacion->cantidad}}" onkeyup="multi();">
              </div>
          </div> 
  

          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Subtotal </label>
              <div class="col-sm-7">
                <div class="input-group">
                <input type="text" class="form-control" name="subtotal" id="subtotal" readonly=”readonly” value="{{$cotizacion->subtotal}}" onkeyup="desc();">
                  <span class="input-group-addon">$</span>
              </div>
          </div> 
     </div> 

      <!--
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Descuento </label>
              <div class="col-sm-7">
                <div class="input-group">
                <input type="text" class="form-control" name="descuento" id="descuento" readonly=”readonly” value="{{$cotizacion->descuento}}"  onkeyup="desc();">
                <span class="input-group-addon">%</span>
              </div>
          </div> 
      </div>
      

          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> SubTotal Con Descuento </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="subtotal_descuento" id="subtotal_descuento" value="{{$cotizacion->subtotal_descuento}}" readonly=”readonly” >
              </div>
          </div> 
      -->

           <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> IVA </label>
              <div class="col-sm-7">
                <div class="input-group">
                <input type="text" class="form-control" name="iva" id="iva" readonly=”readonly” value="{{$cotizacion->iva}}"    onkeyup="total();" >
                <span class="input-group-addon">$</span>
              </div>
          </div> 
      </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Gran Total </label>
              <div class="col-sm-7">
                  <div class="input-group">
                   <input type="text" class="form-control" name="total" id="total" readonly=”readonly” value="{{$cotizacion->total}}">
                 <span class="input-group-addon">$</span>
                 </div>
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
           </div>
       </div>
   </div>
          
</form>

		
@stop

@section("js")

<script type="text/javascript">
    
   /* function sumar()
    {
        var valor1=verificar("costo_unitario");
        var valor2=0.7;
        document.getElementById("precio_unitario").value=parseFloat(valor1)/parseFloat(valor2);
    }
  */

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
        var valor4=verificar("costo_unitario");
        document.getElementById("subtotal").value=parseFloat(valor3)*parseFloat(valor4);
    }

     function desc()
    {
        var valor5=verificar("subtotal");
        //var valor6=verificar("descuento");
        var valor7=16;
        //var valor8=((parseFloat(valor5))-(parseFloat(valor6)*(parseFloat(valor5)/100)));
        var valor9=parseFloat(valor7)*(parseFloat(valor5)/100); 
        //document.getElementById("subtotal_descuento").value=((parseFloat(valor5))-(parseFloat(valor6)*(parseFloat(valor5)/100)));
        document.getElementById("iva").value=parseFloat(valor7)*(parseFloat(valor5)/100);   
        document.getElementById("total").value=parseFloat(valor5)+parseFloat(valor9);   

     }
 
      



    </script>
@stop