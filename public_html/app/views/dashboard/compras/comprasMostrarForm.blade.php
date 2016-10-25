@extends ('dashboard.layouts.default')

@section ('title')
  Pedidos
@stop
@section ('cssPage')
@stop
@section('pagina')
  <h2>Pedidos</h2>
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



<style type="text/css">
#th{
  color: black;
  text-align: center;
  font-weight: bold;
}


#td{
  color: black;
  text-align: center;
  font-weight: bold;
}

#f{
  color: black;
  font-weight: bold;
}


#p{

  color: black;
  text-align: justify;
  line-height: 80%; font-size: 0.9em; 
}





</style>


  <table class="table" >
       <thead>
        <tr><th colspan="5">
          <img src="{{asset('uploads/promosmile.png')}}" /> 
          <br><br>

           <p id="p"><h4><strong>Smile Promotional Solutions, S.A. de C.V.</strong> </h4></p>
           <p id="p">Bosque de Duraznos No. 67 Interior 101B  </p>
           <p id="p"> Bosques de las Lomas, Miguel Hidalgo </p>
           <p id="p">Distrito Federal, </p>
           <p id="p">C.P. 11700 </p>
           <p id="p">RFC:SPS121113BK7</p> </th>

           <th colspan="2"><h3 id="td">Orden de Compra</h3>
            <table class="table" border="1">
              <tr bgcolor="#C0C0C0"><th><h5 id="th">Folio</h5></th><th><h5 id="th">Fecha</h5></th></tr>
               <tr><th><h5 id="td">{{$compras[0]['id']}}</h5></th><th><h6 id="td">{{$compras[0]['fecha']}}</h5></th></tr>



            </table>


           </th>
         </tr>




          <tr>
            <th colspan="3">

              <table class="table" border="1">
               <tr bgcolor="#C0C0C0"><th><h5 id="th">Datos del Proveedor</h5></th></tr>
               <tr><th><h5 id="p">
                  <p>Proveedor: 00{{$proveedor->id}}</p>
                  <p><strong>{{$proveedor->nombre}}</strong></p>
                  <p>Colonia {{$proveedor->colonia}} C.P. {{$proveedor->cp}}, {{$proveedor->municipio}}</p>
                  <p>RFC: {{$proveedor->rfc}}</p>

                        </h5></th></tr>

                </table>

            </th>

            <th></th>
                 <th></th>
              
              <th colspan="2">

              <table class="table" border="1">
               <tr bgcolor="#C0C0C0"><th><h5 id="th">Enviar a:</h5></th></tr>
               <tr><th><h5 id="p">
                  <p>Almacén: {{$compras[0]['nombre']}}. Contacto: {{$compras[0]['persona_contacto']}}. </p>
                  <p>Pais: {{$compras[0]['pais']}}. Municipio: {{$compras[0]['municipio']}}. Colonia: {{$compras[0]['colonia']}}</p>
                  <p>Calle: {{$compras[0]['calle']}} No. interior {{$compras[0]['numinterior']}}. C.P. {{$compras[0]['cp']}}</p>
                    <!--<p>Bosques de las Lomas, Miguel Hidalgo, D.F.</p>-->
                      <p>TLF. {{$compras[0]['telefono']}}. E-mail: {{$compras[0]['email']}}</p>
                        
                        </h5></th></tr>

                </table>

            </th>

               </tr>

                          
        </thead>


    <tbody>
        <tr bgcolor="#C0C0C0">
            <td><h5 id="th">Codigo</h5></td>
              <td><h5 id="th">Descripción</h5></td>
                <td><h5 id="th">Cantidad</h5></td>
                  <td><h5 id="th">Color</h5></td>
                    <td><h5 id="th">Precio Unitario</h5></td>
                      <!--<td><h5 id="th">Descuento</h5></td>-->
                       <td></td>
                       <td><h5 id="th">Subtotal</h5></td>



        </tr>

        <?php $total = 0; ?>
        @foreach($articulos as $c)
        <tr>
            <td><h5 id="td">{{$c['id']}}</h5></td>
              <td><h5 id="td">{{$c['descripcion']}}</h5></td>
                <td><h5 id="td">{{$c['cantidad']}}</h5></td>
                  <td><h5 id="td">{{$c['color']}}</h5></td>
                    <td><h5 id="td">$ {{number_format($c['costo_unitario'],2,".",",")}}</h5></td>
                     <!-- <td><h5 id="td">$ {{$compras[0]['subtotal'] - $compras[0]['subtotal_descuento']}}</h5></td>-->
                        <td></td>
                        <td ><h5 id="td">$ {{number_format($c['costo_unitario']*$c['cantidad'],2,".",",")}} 
                          <a href="{{URL::route('compraEditarForm')}}/{{$c->id}}" class="label label-warning">
                            <i class="fa fa-pencil"></i>
                          </a></h5>
                        </td>
        </tr>
        <?php $total += ($c['costo_unitario']*$c['cantidad']); ?>
        @endforeach

        <tr>
            <td><br></td>
               <td></td>
                    <td></td>
                        <td></td>
                            <td></td>
                                <td></td>



        </tr>

        <tr>
            <td><br></td>
               <td></td>
                    <td></td>
                        <td></td>
                            <td></td>
                                <td></td>



        </tr>

          <tr>
            <td colspan="5" bgcolor="#C0C0C0"><h4 id="th">Observaciones</h4></td>
              <td bgcolor="#C0C0C0"><h5 id="th">Subtotal</h5></td>
                <td><h5 id="td">$ {{number_format($total,2,".",",")}}</h5></td>
               
           </tr>

            <tr>
            <td colspan="5"><h4 id="th"></h4>{{$compras[0]['observaciones']}}</td>
              <td bgcolor="#C0C0C0"><h5 id="th">Iva</h5></td>
                <td><h5 id="td">$ {{number_format(($total*0.16),2,".",",")}}</h5></td>
               
           </tr>

            <tr>
            <td colspan="5"><h4 id="th"></h4></td>
              <td bgcolor="#C0C0C0"><h5 id="th">Total</h5></td>
                <td><h5 id="td">$ {{number_format(($total+($total*0.16)),2,".",",")}}</h5></td>
               
           </tr>
    </tbody>    

 </table>

          <div class="col-md-12">                       
            <div class="form-group">
              <a href="{{URL::route('comprasMostrarPdf')}}/{{$id}}" target="_blank"  class="btn btn-lg btn-success hidden-print pull-right">
                Imprimir  <i class="fa fa-print"></i>
              </a>
                  
              <a id="mi-perfil" href="#"  class="btn btn-lg btn-primary hidden-print pull-right">
                <i class="ti-email"> </i>
                Enviar a Proveedor
              </a>

              <a class="btn btn-lg  btn-warning" href="{{URL::route('compras')}}" >Regresar</a>
            </div>
        </div>
            
          
           
           <div id="lbox-login">
    <i><h4>Enviar Orden De Compra - Proveedor</h4></i>
         <form  action="{{URL::route('enviarEmailProveedor')}}" method="post" class="form-horizontal">
            <input id="token" type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <input id="token" type="hidden" name="id" value="{{$compras[0]['id']}}">

                <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Para: </label>
              <div class="col-sm-7">
              <input type="text" class="form-control" name="para" id="para" readonly value=" {{$proveedor->email}}">
              </div>
          </div> 

          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> CC: </label>
              <div class="col-sm-7">
                <input type="email"  class="form-control" name="cc" id="cc">
              </div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Asunto: </label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" name="asunto" id="asunto">
                </div>
          </div> 

           <div class="form-group">
            <label class="col-sm-2 control-label" for="inputimagen"> Mensaje: </label>
              <div class="col-sm-7">
                <textarea class="form-control autosize area-animated" name="mensaje" id="mensaje" data-autosize-on="true" style="overflow: hidden; resize: horizontal; word-wrap: break-word; height: 71px;" style="text-align:left;">Hola

Por medio de este correo le hago llegar la OC de Smile Promotional Solutions S.A. 
de C.V.
Favor de enviar la mercancía a la dirección de entrega mencionada en el 
documento y entregar a la brevedad.

Favor de confirmar. 
Muchas Gracias 

Saludos</textarea>
              </div>
            </div>
     <div class="col-md-10">                       
            <div class="form-group">
              <button value"" name="guardar" type="submit" class="btn btn-wide btn-primary pull-right">Enviar</button>
              <a class="btn btn-wide btn-warning" href="#" >Cancelar</a>
            </div>
          </div>
            </form>
      </div>
  <div id="capa-oscura"></div>   
   
   
@stop
@section('js')
<script type="text/javascript">
  $(function() {
    $('#mi-perfil').click(function(){
      $('#capa-oscura').show();
      $('#lbox-login').addClass('mostrado');
    })
    $('#mostrar-registro').click(function(){
      $('#lbox-login').removeClass('mostrado');
      $('#lbox-registro').addClass('mostrado');
    })
    $('#capa-oscura').click(function(){
      $(this).hide();
      $('#lbox-login, #lbox-registro').removeClass('mostrado');
    })
  });
</script>
@stop