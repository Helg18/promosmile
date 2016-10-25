@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
 <style type="text/css">
    #leyenda {
      position: absolute;
      border: solid 1px;
      display: none;
      overflow: auto;
      z-index: 100000;
      background: white;
      color: black;
      max-height: 250px;
    }
    .titulo {
      display: block;
      width: 100%;
      text-align: center;
      background: #F3ECEC;
      padding: 5px;
    
    }
    .costo {
      display: block;
      width: 100%;
      background: white;
      padding: 7px;
      text-align: center;
    }
  </style>
@stop

@section("pagina")
  <h2>Editar Cotización </h2>
@stop

@section("contenido")

<div class="alert alert-danger" id="alerta_cantidad" style="display:none"></div>

<form id="form" autocomplete="off" enctype="multipart/form-data"   method="post"  action="{{URL::route('articulos.cotizacion.editar')}}" class="">
 
 <input id="token" type="hidden" name="_token" value="{{{ Session::getToken() }}}">
 <input name="csrf_token" type="hidden" value="{{csrf_token()}}">
 <input name="id" type="hidden" value="{{$cotizacion->id}}">
 <input type="hidden" name="cid" value="{{$cotizacion->cotizacion}}">
 <input type="hidden" id="arti" value="{{URL::route('articulosLoad')}}">
  <div class="container-fluid container-fullw bg-white">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>
            Cotización
          </legend>
          
          <div class="form-group col-md-4">
              <label class=" control-label" for="inputnombrep"> Cliente </label>
              <div class="col-sm-12">
                
               <select name="cliente"  class="js-example-data-array-selected form-control" tabindex="-1" style="display: none;">
                @foreach(Cliente::where("id","=",$ccc->cliente)->get() as $nom)
                  <option value="{{$nom->id}}">{{$nom->nombre}}</option>
                @endforeach
                @foreach($clientes as $cliente)
                <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                @endforeach
              </select>              
            </div>
          </div> 

          <div class="form-group col-md-4">
               <label class=" control-label"> Proveedores </label>
              <div class="col-sm-12">
               
               <select name="proveedor" id="proveedor" class="js-example-data-array-selected form-control" tabindex="-1" style="display: none;">
                  <option>Seleccione un proveedor..</option>
                  @foreach($proveedores as $p)
                    @if($p->id == $cotizacion->proveedor_id)
                      <option selected value="{{$p->id}}">{{$p->nombre}}</option>
                    @else
                      <option value="{{$p->id}}">{{$p->nombre}}</option>
                    @endif
                  @endforeach
               </select>              
              </div>
          </div>                          

            <div class="form-group col-md-4">
              <label class=" control-label" for="inputnombrep"> Artículo </label>
              <div class="col-md-12">
                <select name="articulo" id="articulo" class="js-example-data-array-selected form-control" tabindex="-1" style="display: none;">
                  @foreach($articulos as $articulo)
                    @if($articulo->id == $cotizacion->articulo_id)
                      <option selected value="{{$articulo->id}}">{{$articulo->nombre}}</option>
                    @else
                      <option value="{{$articulo->id}}">{{$articulo->nombre}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
          </div> 

          <div class="form-group col-md-4">
            <label class="control-label" for="inputnombrep"> Descripción </label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{$cotizacion->descripcion}}">
              </div>
          </div> 

          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Cantidad </label>
              <div class="col-md-12">
                <input type="number" max="9999999" min="1"  class="form-control" name="cantidad"  id="cantidad" onkeyup="multi();" value="{{$cotizacion->cantidad}}">
              </div>
          </div> 
  
          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Margen de utilidad  </label>
              <div class="col-md-12">
                <div class="input-group">
                  <input type="number" min="20" class="form-control" name="margen_utilidad" id="margen_utilidad" value="{{$cotizacion->margen_utilidad}}" onblur="utilidad()">
                  <span class="input-group-addon">%</span>
                </div>
              </div> 
          </div>

          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Costo Unitario </label>
              <div class="col-md-12">
                <div class="input-group">
                  <input type="text" class="form-control" name="costo_unitario" id="costo_unitario" value="{{$cotizacion->costo_unitario}}">
                  <span class="input-group-addon">$</span>
                </div>
              </div> 
          </div>
          
         <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Tipo de impresion </label>
              <div class="col-md-10">
                <select name="impresion" id="impresion" class="form-control" data-url="{{URL::route('descripcion')}}">
                  
                  <option value="{{$cotizacion->tipoimpresion}}">{{$cotizacion->tipoimpresion}}</option>
                  <option value="Sin impresion">Sin Impresión</option>                  
                  <option value="Serigrafia">Serigrafía</option>
                  <option value="Tempografia">Tempografia</option>
                  <option value="Grabado">Grabado</option>
                  <option value="Bordado">Bordado</option>
                  <option value="Sublimado">Sublimado</option>
                  <option value="Sand Blast">Sand Blast</option>
                  <option value="Termograbado">Termograbado</option>
              </select>
              </div>
              <div id="signo" class="col-md-2 badge badge-default" style="display:none;cursor:pointer;">?</div>
          </div> 


          <div id="cii" class="form-group col-md-4" style="{{($cotizacion->tipoimpresion == 'Serigrafia' || $cotizacion->tipoimpresion == 'Tempografia' || $cotizacion->tipoimpresion == 'Sand Blast' || $cotizacion->tipoimpresion == 'Bordado')}} ? '' : 'display:none;'">
            <label class=" control-label" id="ii" for="infoimpresion">
              @if($cotizacion->tipoimpresion == 'Serigrafia' || $cotizacion->tipoimpresion == 'Tempografia' || $cotizacion->tipoimpresion == 'Sand Blast') 
                  Tintas
              @else
                  Hilos
              @endif
            </label>
              <div class="col-md-12" >
                <input type="number" name="infoimpresion" value="{{$cotizacion->infoimpresion}}" max="9" min="1" class="form-control"  name="" id="infoimpresion">
              </div>
          </div>



          <div class="form-group col-md-4" id="kostoimpresion">
            <label class=" control-label" for="costoimpresion" > Costo de impresión </label>
              <div class="col-md-12">
                <label class="pull-right" style=" font-size:11px; color: #a33; display:none;" id="div-placas">Incluir placas en el costo de impresion</label>
                <input type="text"  value="{{$cotizacion->costoimpresion}}" class="form-control" onkeyup="multi()" name="costoimpresion" id="costoimpresion">
              </div>
          </div>

          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Precio Unitario </label>
              <div class="col-md-12">
                <div class="input-group">
                <input type="text" class="form-control" name="precio_unitario" id="precio_unitario" value="{{$cotizacion->precio_unitario}}" onkeyup="multi();">
                  <span class="input-group-addon">$</span>
              </div>
              </div> 
          </div> 
          
           <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Descuento que aplica </label>
              <div class="col-md-12">
                <div class="input-group">
                 <input type="text" value="{{$proveedor1->descuento}}" class="form-control" readonly id="descuento_proveedor">
                  <span class="input-group-addon">%</span>
                </div>
              </div> 
          </div>


          <input type="hidden" class="form-control" name="colorh" id="colorh" value="{{$cotizacion->color}}">
          <div class="form-group col-md-4">
              <div class="col-sm-5">
                <label class=" control-label" for=""> Color</label>
                <select name="color" id="color" class="form-control">
                  <option value="0">color...</option>
                    @foreach($cc as $c) 
                    <option value="{{$c->color}}">{{$c->color}}</option>
                    @endforeach
                </select>
              </div>
             
              <div class="col-sm-4" style="display:none;" id="c_cantidad">
                <label class=" control-label" for=""> Cantidad</label>
                <input type="text" id="color_cantidad" class="form-control">
              </div>
              
              <div class="col-sm-3" style="display:none;" id="add_color">
                <label class=" control-label" for="" style="color:white;"> Color</label>
                <a href="javascript:void(0)" id="boton_add" class="btn btn-primary">+</a>
              </div>
          </div>
          <div class="col-md-12" id="colores">
            <?php $c = explode(",", $cotizacion->color); ?>
            @foreach($c as $cc)
              @if($cc != "") 
              <div class='col-sm-3'>
                <input class=' pull-left col-sm-8' type='text' disabled value='{{$cc}}'>
                <a href='javascript:void(0)' class='remover btn btn-danger pull-right'>X</a>
              </div>
              @endif
            @endforeach
          </div>

           

        

    <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Subtotal </label>
              <div class="col-md-12">
                <div class="input-group">
                <input type="text" class="form-control" name="subtotal" id="subtotal" readonly=”readonly”  onkeyup="desc();" value="{{$cotizacion->cantidad*$cotizacion->precio_unitario}}">
                  <span class="input-group-addon">$</span>
              </div>
          </div> 
     </div> 

        
           <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> IVA </label>
              <div class="col-md-12">
                <div class="input-group">
                <input type="text" class="form-control" name="iva" id="iva" readonly=”readonly”  onkeyup="total();" value="{{($cotizacion->cantidad*$cotizacion->precio_unitario)*0.16}}" >
                <span class="input-group-addon">$</span>
              </div>
          </div> 
      </div>


          <div class="form-group col-md-4">
            <label class="control-label" for="inputnombrep"> Gran Total </label>
              <div class="col-md-12">
                  <div class="input-group">
                   <input type="text" class="form-control" name="total" id="total" readonly=”readonly” value="{{$cotizacion->total}}">
                 <span class="input-group-addon">$</span>
                 </div>
              </div>
          </div> 


         <!-- <div class="form-group">
            <label class="col-sm-2 control-label" for="inputimagen"> Imágenes </label>
              <div class="col-sm-7">
               <span class="btn btn-wide btn-default btn-squared fileinput-button"> <i class="glyphicon glyphicon-plus"> </i> 
        <span> Presionar aquí para seleccionar Imágen... </span>
                  <input id="imgs"  type="file" name="images[]"  id="file2" />                
                </span>
              </div>
          </div> 
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep">  Costo de impresión  </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="costoimpresion" id="costoimpresion" value="{{$cotizacion->costoimpresion}}">
              </div>
          </div> 
          -->
          
          
         <!-- <div class="form-group">
            <label class="col-sm-2 control-label" for="inputimagen"> Observaciones </label>
              <div class="col-sm-7">
                <textarea class="form-control autosize area-animated" value="{{$cotizacion->observaciones}}" name="observaciones" id="observaciones" data-autosize-on="true" style="overflow: hidden; resize: horizontal; word-wrap: break-word; height: 71px;">
                  {{$cotizacion->observaciones}}
                </textarea>
              </div>
            </div>
          </div>-->
        </fieldset>

          <div class="col-md-12">                       
            <div class="form-group">
              <button id="guardar" type="submit" class="btn btn-wide btn-primary pull-right">
                Guardar
              </button>
              <a class="btn btn-wide btn-warning" href="{{URL::route('articulos.cotizacion')}}/{{$cotizacion->cotizacion}}" >Regresar</a>
            </div>
          </div>
           </div>
       </div>
   </div>
          
</form>

    
@stop

@section("js")
<script src="{{asset('assets/js/cotizacion.js')}}"></script>
<script type="text/javascript">
    
 
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

   /*function utilidad () {
        var valorm= parseFloat(verificar("margen_utilidad")) || 0; 
        if (parseFloat(valorm)<27) {
          alert("El margen de utilidad es menor a 27%");
        }
        
     }*/

     function utilidad () {
        var valorm= parseFloat(verificar("margen_utilidad")) || 0; 
        if (parseFloat(valorm)<27) {
           $("#alerta_cantidad").html("El margen de utilidad es menor a 27%");
           $("#alerta_cantidad").show();
           $(document).scrollTop(0);
           setTimeout(function(){
              $("#alerta_cantidad").hide()
          },5000);
        }
        
     }

     
     function multi()
    {
        var valor3= verificar("cantidad");
        var ci = parseFloat(verificar("costoimpresion"));
        var valorcu=verificar("costo_unitario");  
        var valorm= parseFloat(verificar("margen_utilidad")) 
        
        var des = $("#descuento_proveedor").val()
        if ($("#descuento_proveedor").val() == null || $("#descuento_proveedor").val() == 0) {
          var value=((parseFloat(valorcu)+parseFloat(ci))/(1-(parseFloat(valorm)/100))).toFixed(2); 
        } else {
          var value=((parseFloat(valorcu)-((parseFloat(valorcu)*des)/100)+parseFloat(ci))/(1-(parseFloat(valorm)/100))).toFixed(2); 
          console.log((parseFloat(valorcu)-((parseFloat(valorcu)*des)/100)));
        }  

        document.getElementById("precio_unitario").value = value;

        var valor4=parseFloat(verificar("precio_unitario"));
        valor4 +=  ci;
        //var t = (valor3*valor4) + (valor3*valor4)*0.16;
        var t = (valor3*value) + (valor3*value)*0.16;
        //var ii = parseFloat(valor3)*(parseFloat(valor4)*0.16);
        var su = parseFloat(valor3)*parseFloat(value);

        var ii = (parseFloat(su)*0.16);
        var iii = ii.toFixed(2);
        
        var ss = su.toFixed(2);
   document.getElementById("subtotal").value=ss;
   document.getElementById("iva").value=iii; 
   document.getElementById("total").value=parseFloat(t).toFixed(2);

        
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
 
    $(document).ready(function(){
       colores_cantidad = {{$cotizacion->cantidad}};
       colores = "{{$cotizacion->color}}";
       get = 1;
      $("#proveedor").change(function(){
       $.ajax({
          url: $("#arti").val(),
          type: "post",
          data: {
            id:$("#proveedor").val(),
            _token: $("#token").val()
          },
          dataType: "json",
          success: function(data){
            var op = "<option>Seleccione articulo...</option>"
            if(data.pro.descuento != null) {
              $("#descuento_proveedor").val(data.pro.descuento);  
            } else {
              $("#descuento_proveedor").val(0);  
            }
            for (var i = 0 in data.ar) {
              op += "<option value='"+data.ar[i].id+"'>"+data.ar[i].nombre+"</option>"
            }
            $("#articulo").html(op);
          }
        });
      });
      
      $("#form").submit(function(){
          if(colores_cantidad == $('#cantidad').val()) {
            return true;
          } else {
            $("#alerta_cantidad").html("La cantidad de colores no es igual a lo ingresado en el campo cantidad");
            $("#alerta_cantidad").show();
            $(document).scrollTop(0);
            setTimeout(function(){
            $("#alerta_cantidad").hide()
        },5000);
        return false;
       }
      });
    }); 



    </script>
@stop