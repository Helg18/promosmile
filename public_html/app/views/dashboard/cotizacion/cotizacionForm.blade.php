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
  <h2>Registro de cotización </h2>
@stop

@section("contenido")



@if(Session::get("msj") != null)
<div class="alert alert-danger">
    No ha agregado ningun articulo...
</div>
@endif
<div class="alert alert-danger" id="alerta_cantidad" style="display:none">
    
</div>

<input type="hidden" id="url" value="{{URL::route('clientesSaveNew')}}">
<fieldset id="addP" style="display:none;">
  <legend>Registrar Cliente</legend>
  <div class="form-group col-md-3">
      <small id="cn">Nombre</small>  
      <input type="text" class="form-control" placeholder="Nombre" id="nombrep">
  </div>
  <div class="form-group col-md-3">
      <small id="cc">Contacto</small>  
      <input type="text" class="form-control" placeholder="Persona contacto" id="pcp">
  </div>
  <div class="form-group col-md-3">
      <small id="ce">E-mail</small>  
      <input type="text" class="form-control" placeholder="E-mail" id="mail">
  </div>
  <div class="form-group col-md-3">
      <small id="ct">Telefono</small>  
      <input type="text" class="form-control" placeholder="Telefono" id="tlf">
  </div>
  <div class="form-group col-md-3">
      <a href="#" id="rc" class="btn btn-success">Registrar Cliente</a>
  </div>
</fieldset>

<fieldset data-url="{{URL::route('colorSaveAjax')}}" id="add-color" style="display:none;">
    <legend>Registrar Color</legend>  
    <form >
        <div class="col-sm-4">
        <input type="text" class="form-control" id="color-ajax" placeholder="Color">
        </div>
        <a href="#" id="save-color" class="btn btn-success">Guardar</a>
    </form>
</fieldset>


<form id="form" autocomplete="off" enctype="multipart/form-data"   method="post"  action="{{URL::route('cotizacionSave')}}">
 
 <input id="token" type="hidden" name="_token" value="{{{ Session::getToken() }}}">
 <input type="hidden" id="arti" value="{{URL::route('articulosLoad')}}">
 <input name="csrf_token" id="token" type="hidden" value="{{csrf_token()}}">
 
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
               <select class="js-example-data-array-selected form-control" tabindex="-1" style="display: none;" name="cliente" id="cliente">
                  <option value="0">Seleccione un cliente..</option>
                  @foreach($clientes as $cliente)
                  <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                  @endforeach
               </select>              
              </div>
          </div> 
          <div class="form-group col-md-2">
           <br>
            <a href="#" id="newc" class="btn btn-success">Registrar cliente</a>
          </div>
          <div class="form-group col-md-4">
           <br>
            <a href="#" id="form-color" class="btn btn-success">Registrar color</a>
          </div>

          
            
          <div class="form-group col-md-4">
            <!--<label class=" control-label" for="inputnombrep"> Almacenes </label>
              <div class="col-sm-12">
               <select name="almacen"  class="form-control">
                  <option>Seleccione un almacen..</option>
                  @foreach($almacenes as $a)
                  <option value="{{$a->id}}">{{$a->nombre}}</option>
                  @endforeach
               </select>              
              </div>-->
          </div>                      


        <div id="content_sub">          
        <fieldset class="col-md-12" id="art_1">
          
          <div class="form-group col-md-4">
            <label class=" control-label"> Proveedores </label>
              <div class="col-sm-12">
               <select class="js-example-data-array-selected form-control" tabindex="-1" style="display: none;" name="proveedor" id="proveedor" class="form-control">
                  <option id="suplidor">Seleccione un proveedor..</option>
                  @foreach($proveedores as $p)
                  <option value="{{$p->id}}">{{$p->nombre}}</option>
                  @endforeach
               </select>              
              </div>
          </div>              

          <div class="form-group col-md-4">
            <label class=" control-label" for=""> Artículo </label>
              <div class="col-md-12">
                <select class="js-example-data-array-selected form-control" tabindex="-1" style="display: none;" name="articulo" id="articulo" class="form-control" data-url="{{URL::route('descripcion')}}">
                  <option value="">Seleccione un articulo..</option>
                  
                </select>
              </div>
          </div> 

          <div class="form-group col-md-4">
            <label class=" control-label" for=""> Descripción </label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="descripcion" id="descripcion" >
              </div>
          </div>
          
          <div class="form-group col-md-4">
            <label class="control-label" for="inputnombrep"> Cantidad </label>
              <div class="col-md-12">
                <!--<input type="number" max="9999999" min="1"  class="form-control" name="cantidad"  id="cantidad" onkeyup="multi();"> -->
                <input type="number" max="9999999" min="1"  class="form-control" name="cantidad" onkeyup="multi()"  id="cantidad" >
                
              </div>
          </div>

           <div class="form-group col-md-4">
            <label class="control-label" for="inputnombrep"> Margen de utilidad </label>
              <div class="col-md-12">
                <div class="input-group">
                    <input type="number" min="20" class="form-control" name="margen_utilidad" onkeyup="multi()" id="margen_utilidad" onblur="utilidad()">
                    <span class="input-group-addon">%</span>
                </div>
              </div> 
          </div>

          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Costo Unitario </label>
              <div class="col-md-12">
                <div class="input-group">
                    <!-- <input type="text" class="form-control" name="costo_unitario" id="costo_unitario" onkeyup="sumar();">  si se quiere usar la función sumar-->
                    <input type="text" class="form-control" name="costo_unitario" id="costo_unitario" onkeyup="multi()" > 
                    <span class="input-group-addon">$</span>
                </div>
              </div> 
          </div>  
          
          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Tipo de impresion </label>
              <div class="col-md-10">
                <select name="impresion" id="impresion" class="form-control" data-url="{{URL::route('descripcion')}}">
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
          
           <div id="cii" class="form-group col-md-4" style="display:none;">
            <label class=" control-label" id="ii" for="infoimpresion"></label>
              <div class="col-md-12" >
                <input type="number" max="9" min="1" class="form-control"  name="" id="infoimpresion">
              </div>
          </div>

          


           <div class="form-group col-md-4" id="kostoimpresion" style="display:none;">
            <label class=" control-label" for="costoimpresion" > Costo de impresión </label>
              <div class="col-md-12">
                  <label class="pull-right" style=" font-size:11px; color: #a33; display:none;" id="div-placas">Incluir placas en el costo de impresion</label>
                <input type="text" placeholder="0.00" class="form-control" onkeyup="multi()" name="" id="costoimpresion" >
              </div>
          </div>


          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Precio Unitario </label>
              <div class="col-md-12">
                <div class="input-group">
                 <!--<input type="text" class="form-control" name="precio_unitario" id="precio_unitario" onkeyup="multi();"> -->
                 <input type="text" class="form-control"  readonly name="precio_unitario" onkeyup="multi()" id="precio_unitario" >
                 
                  <span class="input-group-addon">$</span>
                </div>
              </div> 
          </div>

          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Descuento que aplica </label>
              <div class="col-md-12">
                <div class="input-group">
                 <input type="text" class="form-control" readonly id="descuento_proveedor">
                  <span class="input-group-addon">%</span>
                </div>
              </div> 
          </div>

          
          
           <div class="form-group col-md-4">
            <label class=" control-label"> Color </label>
              <div class="col-sm-12">
               <select class="js-example-data-array-selected form-control" tabindex="-1" style="display: none;" name="color" id="color" class="form-control">
                  
                  <option id="cero" value="0">color...</option>
                  
                  @foreach($cc as $c)
                    <option value="{{$c->color}}">{{$c->color}}</option>
                  @endforeach
                    <!--<option value="Azul">Azul</option>
                    <option value="Rojo">Rojo</option> 
                    <option value="Verde">Verde</option> 
                    <option value="Naranja">Naranja</option>  
                    <option value="Morado">Morado</option>
                    <option value="Amarillo">Amarillo</option>
                    <option value="Rosa">Rosa</option>
                    <option value="Café">Café</option> 
                    <option value="Beige">Beige</option>
                    <option value="Vino">Vino</option>
                    <option value="Blanco">Blanco</option>
                    <option value="Transparente">Transparente</option>
                    <option value="Negro">Negro</option>
                    <option value="Gris">Gris</option>
                    <option value="Plata">Plata</option>
                    <option value="Dorado">Dorado</option>
                    <option value="Azul Claro">Azul Claro</option>
                    <option value="Verde Claro">Verde Claro</option>-->
               </select>              
              </div>
              
          </div>              
          <div class="form-group col-md-4">
            <div class="col-sm-4" style="display:none;" id="c_cantidad">
                <label class=" control-label" for=""> Cantidad</label>
                <input type="text" id="color_cantidad" class="form-control">
            </div>
              
            <div class="col-sm-3" style="display:none;" id="add_color">
                <label class=" control-label" for="" style="color:white;"> Color</label>
                <a href="javascript:void(0)" id="boton_add" class="btn btn-primary">+</a>
            </div>
          </div>

          <div class="col-md-12" id="colores"></div>

           

          
          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Subtotal </label>
              <div class="col-md-12">
                <div class="input-group">
                   <input type="text" class="form-control" name="subtotal" id="subtotal" readonly=”readonly” value="0" onkeyup="desc();">

                  <span class="input-group-addon">$</span>
                </div>
              </div> 
          </div> 

          <div class="form-group col-md-4">
            <label class="control-label" for="inputnombrep"> IVA </label>
              <div class="col-md-12">
                <div class="input-group">
                  <!--<input type="text" class="form-control" name="iva" id="iva" readonly=”readonly” value="0"  onkeyup="total();" > -->
                  <input type="text" class="form-control" name="iva" id="iva" readonly=”readonly” value="0" >
                 
                  <span class="input-group-addon">$</span>
                </div>
              </div> 
          </div>


          <div class="form-group col-md-4">
            <label class=" control-label" for="inputnombrep"> Gran Total </label>
              <div class="col-md-12">
                  <div class="input-group">
                   <input type="text" class="form-control" name="total" id="total" readonly=”readonly” value="0">
                 <span class="input-group-addon">$</span>
                 </div>
              </div>
          </div>

          <div class="form-group col-md-12">            
            <center><a id="add_art" onclick="addSub()" class="fa fa-plus btn btn-primary">Agregar Artículo</a></center>               
          </div> 
          
        </fieldset>
        <input name="count_sub" id="count_sub" type="hidden" value="0">
        </div>



          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputimagen"> Observaciones </label>
              <div class="col-sm-7">
                <textarea class="form-control autosize area-animated" name="observaciones" id="observaciones" data-autosize-on="true" style="overflow: hidden; resize: horizontal; word-wrap: break-word; height: 71px;">
                </textarea>
              </div>
            </div>
          </div>
          
      
          <div class="col-md-12">                       
            <div class="form-group">
              <button id="sut" value"2" name="guardar" type="submit" class="btn btn-wide btn-primary pull-right">
                Vista previa
              </button>

              <!--<button value="1" name="enviar" type="submit" class="btn btn-dark-green pull-right">
                Guardar y Enviar
              </button>-->

              <a class="btn btn-wide btn-warning" href="{{URL::route('cotizacion')}}" >Regresar</a>
            </div>
          </div>

           </div>
       </div>
   </div>
        </fieldset>  
</form>


    
@stop

@section("js")
<script src="{{asset('assets/js/cotizacion.js')}}"></script>

<script type="text/javascript">
   
    /* 
    function sumar()
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
   document.getElementById("total").value=parseFloat(t).toFixed(2);//+parseFloat(valor9);  

        
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

    <script type="text/javascript">

  var num_sub = 0
  var sub_cero = 0;
  


  evento = function (evt) {
  return (!evt) ? event : evt;
  }

    addSub = function () { 
    console.log(colores_cantidad +" - "+ $('#cantidad').val());
    if($("#margen_utilidad").val() <= 0) { 
        $("#alerta_cantidad").html("seleccione el margen de utilidad");
        $("#alerta_cantidad").show();
        $(document).scrollTop(0);
        setTimeout(function(){
          $("#alerta_cantidad").hide()
        },5000);
        return false;
    }
    
    if(colores_cantidad == $('#cantidad').val()) {
    for(var i = 0 in removidos) {
      $("#color").append("<option value='"+removidos[i]+"'>"+removidos[i]+"</option>");
    }
    removidos = [];
    var subtot=$('#subtotal').val();

    var p= $('#precio_unitario').val();
    var c= $('#cantidad').val();

    subtot=parseFloat(subtot)+(parseFloat(p)*parseFloat(c));
    var impuesto=parseFloat(subtot)+(parseFloat(subtot)*0.16);
    //aplicar formula para total
    var total=impuesto;
    var tt = $('#total').val();
    var ii = $('#iva').val();
    var ss = $('#subtotal').val();
    $('#subtotal').val(0);
    $('#iva').val(0);
    $('#total').val(0);


    
    //si se agrega una subcategoria el input id="content_sub" cambia a 1
    document.getElementById("count_sub").value = 1;
    sub_cero = ++num_sub;
    
  var container = document.getElementById('content_sub');
    
    var div     = document.createElement("fieldset");
    div.className   = 'form-inline';
    div.style.marginBottom = "2%";
    //div.style.minWidth = "858.75px";
    //div.style.overflow = "scroll";
         
      var sele = document.createElement('input');
      var identificador= 'subcategorias'+sub_cero;
        sele.type = 'hidden'; 
        sele.name = 'subcategorias[]'; 
        sele.id = identificador;
        sele.className="articulos"; 
        sele.value=$('#articulo').val(); 
      var sele1 = document.createElement('input');
      //var identificador= 'subcategorias'+sub_cero;
        sele1.type = 'text'; 
        sele1.readonly = 'readonly'; 
        sele1.name = 'sub[]'; 
        sele1.id = identificador;
        sele1.className="articulos"; 
        sele1.value=$('#articulo :selected').text();          
      
      var input2       = document.createElement("input");
        input2.type    = 'number';
        input2.readOnly = true; 
        input2.min     = '1';     
        input2.name    = 'subcategorias2[]';
        input2.placeholder    = 'Cantidad';
        input2.required = 'required';
        input2.className = 'cantidad';
        input2.value=$('#cantidad').val();           

        var descripcion       = document.createElement("input");
        descripcion.type    = 'text';             
        descripcion.readOnly = true; 
        descripcion.name    = 'descripcion1[]';
        descripcion.placeholder    = 'Descripcion';       
        descripcion.className = 'descripcion';
        descripcion.value=$('#descripcion').val();           

        var color       = document.createElement("input");
        color.type    = 'text';
        color.readOnly = true;             
        color.name    = 'color1[]';
        color.placeholder    = 'Color';       
        color.className = 'color';
        color.value= colores; //$('#color').val();

        var costo     = document.createElement("input");
        costo.type    = 'text';
        costo.readOnly = true;
        costo.min     = '1';     
        costo.name    = 'costo1[]';
        costo.placeholder    = 'Costo';
        costo.required = 'required';
        costo.className = 'costo1'; 
        costo.value=$('#costo_unitario').val();           


        var margen_utilidad       = document.createElement("input");
        margen_utilidad.type    = 'number';
        margen_utilidad.readOnly = true;
        margen_utilidad.min     = '20';     
        margen_utilidad.name    = 'margen_utilidad1[]';
        margen_utilidad.placeholder    = 'margen_utilidad';
        margen_utilidad.required = 'required';
        margen_utilidad.className = 'margen_utilidad'; 
        margen_utilidad.value=$('#margen_utilidad').val();           


        var precio_unitario       = document.createElement("input");
        precio_unitario.type    = 'text';
        precio_unitario.readOnly = true;
        precio_unitario.min     = '0';     
        precio_unitario.name    = 'precio_unitario1[]';
        precio_unitario.placeholder    = 'precio_unitario';
        precio_unitario.required = 'required';
        precio_unitario.className = 'precio_unitario'; 
        precio_unitario.value=$('#precio_unitario').val();           

        var total       = document.createElement("input");
        total.type    = 'text';     
        total.readOnly = true;
        total.name    = 'totale[]';
        total.placeholder    = 'total';
        total.required = 'required';
        total.className = 'total'; 
        total.value = tt;

        var costoimpresion = document.createElement("input");
        costoimpresion.type    = 'hidden';     
        costoimpresion.name    = 'costoimpresion[]';
        costoimpresion.placeholder    = 'costo impresion';
        costoimpresion.required = 'required';
        costoimpresion.className = 'costoimpresion'; 
        costoimpresion.value = $("#costoimpresion").val();

        var tipoimpresion = document.createElement("input");
        tipoimpresion.type    = 'hidden';     
        tipoimpresion.name    = 'tipoimpresion[]';
        tipoimpresion.placeholder    = 'tipo impresion';
        tipoimpresion.required = 'required';
        tipoimpresion.className = 'tipoimpresion'; 
        tipoimpresion.value = $("#impresion").val();

        var infoimpresion = document.createElement("input");
        infoimpresion.type    = 'hidden';     
        infoimpresion.name    = 'infoimpresion[]';
        infoimpresion.placeholder    = '';
        infoimpresion.required = 'required';
        infoimpresion.className = 'infoimpresion'; 
        infoimpresion.value = $("#infoimpresion").val();


        var iva = document.createElement("input");
        iva.type    = 'hidden';     
        iva.name    = 'iva1[]';
        iva.placeholder    = '';
        iva.required = 'required';
        iva.className = 'iva'; 
        iva.value = ii;

        var proveedor = document.createElement("input");
        proveedor.type    = 'hidden';     
        proveedor.name    = 'proveedores[]';
        proveedor.placeholder    = '';
        proveedor.required = 'required';
        proveedor.className = 'proveedor'; 
        proveedor.value = $("#proveedor").val();

        var sub = document.createElement("input");
        sub.type    = 'hidden';     
        sub.name    = 'sub1[]';
        sub.placeholder    = '';
        sub.required = 'required';
        sub.className = 'sub'; 
        sub.value = ss;
             
             

      var a       = document.createElement('i');
        a.style.cursor  = 'pointer';
        a.className   = 'fa fa-trash-o btn bnt-wide btn-red';
        a.style.marginLeft = "1%";
        a.onclick   = function() { 
                  this.parentNode.parentNode.removeChild(this.parentNode); 
                  sub_cero= --num_sub;
                  if(sub_cero == 0) {
                    document.getElementById("count_sub").value = 0;
                  }
                };      

    div.appendChild(iva);
    div.appendChild(sub);
    div.appendChild(sele);
    div.appendChild(proveedor);
    $(div).append(" <input type='text' style='border:none;' readonly value='Articulo'>");
    $(div).append(" <input type='text' style='border:none;' readonly value='Descripción'>");
    $(div).append(" <input type='text' style='border:none;' readonly value='Color'>");
    $(div).append("<br>");
    
    div.appendChild(sele1);    
    div.appendChild(descripcion);
    div.appendChild(color);
    $(div).append("<br>");
    $(div).append(" <input type='text' style='border:none;' readonly value='Costo unitario'>");
    $(div).append(" <input type='text' style='border:none;' readonly value='Margen de utilidad'>");
    $(div).append(" <input type='text' style='border:none;' readonly value='Precio unitario'>");
    $(div).append("<br>");
    div.appendChild(costo);
    div.appendChild(margen_utilidad); 
    div.appendChild(precio_unitario);
    $(div).append("<br>");
    $(div).append(" <input type='text' style='border:none;' readonly value='Cantidad'>");
    $(div).append(" <input type='text' style='border:none;' readonly value='Total'>"); 
    $(div).append("<br>"); 
    div.appendChild(input2); 
    div.appendChild(total);
    div.appendChild(tipoimpresion); 
    div.appendChild(infoimpresion);
    div.appendChild(costoimpresion);
    $(div).append(" <i id='edit' class='ti-pencil btn bnt-wide btn-yellow'></i>");
    $(div).append("<input type='hidden' class='colores_cantidad' value='"+colores_cantidad+"'>");


    div.appendChild(a);
  container.appendChild(div);

 //$('#articulo').val('');


//Limpiando los campo
 $('#proveedor > option').removeAttr('selected').change();
 $('#impresion > option').removeAttr('selected').change();
 $('#articulo').html("<option>Seleccione un articulo...</option>").change();
 $('#descripcion').val('');
 $('#descuento_proveedor').val('');
 $('#costoimpresion').val('');
 $('#color').val(''); 
 $('#infoimpresion').val(''); 
 $('#costo_unitario').val('');
 $('#margen_utilidad').val('');
 $('#precio_unitario').val('');
 $('#cantidad').val('');
 colores = "";
 colores_cantidad = 0;




 $("#colores").html("");
  } else {
    $("#alerta_cantidad").html("La cantidad de colores no es igual a lo ingresado en el campo cantidad");
    $("#alerta_cantidad").show();
    $(document).scrollTop(0);
    setTimeout(function(){
      $("#alerta_cantidad").hide()
   },5000);
  }
}

$(document).ready(function(){
    $("#newc").click(function(){
       $("#addP").show();
       $(this).hide();
    });
    $("#form-color").click(function(){
       $("#add-color").show();
       $(this).hide();
    });
    $("#rc").click(function(){
      
      $.ajax({
        url: $("#url").val(),
        type: "post",
        data: {
          nombre:   $("#nombrep").val(),
          contacto: $("#pcp").val(),
          mail:     $("#mail").val(),
          tlf:      $("#tlf").val(),
          _token:   $("#token").val()
        },
        dataType: "json",
        success: function(data){
          $("#addP").hide();
          var opt = "<option>Selcione cliente...</option>";
          for (var i = 0 in data.cc) {
            opt += "<option value='"+data.cc[i].id+"'>"+data.cc[i].nombre+"</option>";
            console.log(data.cc[i].nombre);
          }
          $("#cliente").html(opt);
          console.log("ok");
        }
      });
    });
    $("#save-color").click(function(){
      
      $.ajax({
        url: $("#add-color").attr("data-url"),
        type: "post",
        data: {
           color:   $("#color-ajax").val(),
          _token:   $("#token").val()
        },
        dataType: "json",
        success: function(data){
          $("#add-color").hide();
          $("#form-color").show();
          var opt = "<option>Color</option>";
          for (var i = 0 in data.cc) {
            opt += "<option value='"+data.cc[i].color+"'>"+data.cc[i].color+"</option>";
          }
          $("#color").html(opt);
          console.log("ok");
        }
      });
    });
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
            var op = "<option value='default'>Seleccione articulo...</option>"
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

      $("#i").keyup(function(){
        var val = $(this).val();
        
        $("#a option").each(function(){
          if($(this).text().toLowerCase() == val.toLowerCase()) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      });
});
</script>
@stop