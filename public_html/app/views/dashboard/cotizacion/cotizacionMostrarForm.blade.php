@extends ('dashboard.layouts.default')

@section ('title')
  Cotización
@stop
@section ('cssPage')
@stop
@section('pagina')
  <h2>Cotización</h2>
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
  color: white;
  text-align: center;
  font-weight: bold;
}


#td{
  color: black;
  text-align: center;
  font-weight: bold;
}

.b1 {
  border-top: solid 2px black;
  border-bottom: solid 2px black;
}

#f{
  color: black;
  font-weight: bold;
}


#p{
  width: 100%;
  font-size: 12px;
  color: black;
  text-align: justify;
  white-space: pre-line;
  margin: .1em;
}





</style>


  <table class="table">
       <thead>
        <tr width="100%" ><th colspan="7">
          <img width="200px" src="{{asset('uploads/promosmile.png')}}" /> 
          <br><br>

           <p id="p"><h4><strong>Smile Promotional Solutions, S.A. de C.V.</strong> </h4></p>
           <p id="p">Bosque de Duraznos No. 67 Interior 101B  </p>
           <p id="p"> Bosques de las Lomas, Miguel Hidalgo </p>
           <p id="p">Distrito Federal, C.P. 11700 </p>
           <p id="p">RFC:SPS121113BK7</p> <p></p></th>

           <th><h3 id="td">Cotización</h3>
            <table class="table" border="solid 2px" bordercolor="black">
              <tr bgcolor="green"><th colspan="2" style="border-bottom:2px solid black"><h5 id="th">Folio</h5></th><th colspan="2" width="80%" style="border-bottom:2px solid black"><h5 id="th">Fecha</h5></th></tr>
               <tr><th colspan="2" ><h6 id="td">{{$cotizacion->id}}</h6></th><th colspan="2" ><h6 id="td">
                <?php $date = date_create($cotizacion->fecha); ?>
                {{date_format($date,"d-m-Y")}}</h5></th></tr></th>
            </table>


         
         </tr>



         <table class="table"  border="2px" bordercolor="000000" border>
          <tr>
            <th  bgcolor="#e35416" colspan="8" style="border-bottom:2px solid black"><h2 id="th">Datos del cliente</strong></th>
              </tr>
                 <tr>
                  @foreach($cliente as $clientes)
                  <th  colspan="2"><h5 id="f">Nombre: {{$clientes->persona_contacto}}</h5></th> <th  colspan="2"><h5 id="f">Empresa: {{$clientes->nombre}}</h5> </th>
                     </tr>
                       <tr>
                          <th  colspan="2"><h5 id="f">E-mail: {{$clientes->email}}</h5></th> <th  colspan="2"><h5 id="f">Télefono: {{$clientes->telefono}}</h5></th>
                           </tr>

                           @endforeach
        </thead>
      </table><br>
<table class="table" border="2px" bordercolor="000000">
    <tbody >
        <tr bgcolor="green">
            <td style="border-bottom:2px solid black"><h5 id="th">Codigo</h5></td>
              <td width="100%" style="border-bottom:2px solid black"><h5 id="th">Descripción</h5></td>
              <td width="100%" style="border-bottom:2px solid black"><h5 id="th">Color</h5></td>
                <td width="100%" height="100%" colspan="2" style="border-bottom:2px solid black"><h5 id="th">Imagen</h5></td>
                  <td style="border-bottom:2px solid black"><h5 id="th" >Cantidad</h5></td>
                    <td style="border-bottom:2px solid black"><h5 id="th">Precio Unitario</h5></td>
                     <!--<td bordercolor="1111111"><h5 id="th"></h5></td>
                      <td><h5 id="th"></h5></td>-->
                        <td colspan="2" style="border-bottom:2px solid black"><h5 id="th" >Total</h5></td>




        </tr>

        <?php 
            $sub = 0;
            $iva = 0;
            $pp  = 0;
         ?>
        @foreach($ca as $c)
        <tr>

            <td><h5 id="td">{{$c->id}}</h5></td>
              <td width="100%"><h5 id="td">
                {{$c->descripcion}} <br>
                {{$c->tipoimpresion}} <br>
                  @if($c->tipoimpresion == "Serigrafia" || $c->tipoimpresion == "Tempografia"  || $c->tipoimpresion == "Sand Blast") 
                     {{$c->infoimpresion}}Tintas
                  @endif 
                  @if($c->tipoimpresion == "Bordado") 
                    Hilos: {{$c->infoimpresion}}
                  @endif
              </h5>
            </td>
            <td>
              <h5 id="td">
                <?php 
                  //$s   = str_replace(",", "<br>", $c->color); 
                  $val = floatval(substr(strstr($c->color,":"),1));
                  $co  = strstr($c->color,":",true);   
                ?>
                {{$co.":".number_format($val,2)."<br>"}}
              </h5>
            </td>
                <td width="100%" height="100%" colspan="2"><h5 id="td"><img width="100px" height="100px" src="../{{$c->imagen}}"/></h5></td>
                  <td><h5 id="td">{{number_format($c->cantidad,2)}}</h5></td>
                    <td >
                      <h5 id="td">
                      {{number_format(($c->precio_unitario+$c->costoimpresion), 2, ".", ",")}}
                    </h5>
                  </td>
                      <!--<td ><h5 id="td"></h5></td>
                      <td></td>-->
                       <td colspan="2"><h5 id="td">$ {{number_format($c->total, 2, ".", ",")}}</h5></td>
        </tr>
        <!--Decomentar para imprimir las plcas en los presupuestos-->
        <!--@if($c->placas > 0)
            <tr >
              <td ><h5 id="td"></h5></td>
              <td ><h5 id="td">Placassssssssssssssssssssssssssssssssssssssssss</h5></td>
              <td ><h5 id="td"></h5></td>
              <td  colspan="2" ><h5 id="td"></h5></td>
              <td ><h5 id="td">{{$c->placas}}</h5></td>
              <td ><h5 id="td"></h5></td>
              <?php $pp += ($c->placas*150); ?>
              <td  colspan="2" ><h5 id="td">${{number_format($c->placas*150,2,".",",")}}</h5></td>
            </tr>
        @endif-->
        <?php $sub += $c->total;  ?>
        <p></p>
        @endforeach
<!--
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
         -->
          <tr>
            <td class="b1" colspan="6" bgcolor="#e35416" style="border:2px solid black "><h4 id="th">Observaciones</h4></td>
            <?php $t = $sub+$pp ?>
              <td bgcolor="green" style="border-top:2px solid black"><h5 id="th">Subtotal</h5></td>
                 <td style="border-top:2px solid black"><h5 id="td">$ {{number_format(($t), 2, ".", ",")}}</h5></td>
               
           </tr>

            <tr>
            <td colspan="6"><h4 id="th"></h4>{{$cotizacion->observaciones}}</td>
              <td bgcolor="#e35416" style="border-top:2px solid black"><h5 id="th">IVA</h5></td>
                <td style="border-top:2px solid black"><h5 id="td">$ {{number_format($t*0.16, 2, ".", ",")}}</h5></td>
               
           </tr>

            <tr>
            <td colspan="6"><h4 id="th"></h4></td>
              <td bgcolor="green" style="border-top:2px solid black"><h5 id="th">Total</h5></td>
                <td style="border-top:2px solid black"><h5 id="td">$ {{number_format($t+($t*0.16), 2, ".", ",")}}</h5></td>
               
           </tr>
    </tbody>    

 </table>
<br>
 <p id="p">*Existencia en constante movimiento, el precio podría variar sin previo aviso. </p>
 <p id="p">*La cotización es válida  hasta 8 días posterior a la fecha del documento. </p>
 <p id="p">*Las condiciones de pago son 50% anticipo y 50% contra entrega. </p>
 <p id="p">*El tiempo de entrega es de 6 a 8 días hábiles. </p>
 <p id="p">*Contamos con entregas urgentes, sin embargo, Promosmile no se hace responsable por cualquier defecto en pedidos de carácter urgente. </p>
 <p id="p">*Una vez autorizado el pedido no se aceptan cancelaciones ni cambios, de ser así, el costo generado correrá por cuenta del cliente.</p> 
 <p id="p">*La entrega de la mercancía está incluida en el precio, siempre y cuando rebase los $3,000.00 (Tres mil pesos 00/100 MN) antes de IVA   y sea dentro del Distrito Federal y Área Metropolitana, de lo contrario favor de consultarlo con su ejecutivo.</p>



<br>
          <div class="col-md-12">                       
            <div class="form-group">
              <a href="#" id="mi-perfil" class="btn btn-lg  btn-primary"> Enviar   <i class="ti-email"> </i></a>

        <!--  <a href="{{URL::route('enviarEmailCliente')}}/{{$cotizacion->id}}"  class="btn btn-lg  btn-primary">
                <i class="ti-email"> </i>
                Enviar 
               </a>  --> 

                <a class="btn btn-lg btn-warning pull-right"  href="{{URL::route('cotizacion')}}" >Regresar</a>

              <a href="{{URL::route('cotizacionMostrarPdf')}}/{{$cotizacion->id}}" target="_blank"  class="btn btn-lg btn-primary hidden-print pull-right">
                Imprimir  <i class="fa fa-print"></i>
              </a>

            </div>
          </div>   
 <div id="lbox-login">
    <i><h4>Enviar Cotización -  Cliente</h4></i>
         <form  action="{{URL::route('enviarEmailCliente')}}" method="post" class="form-horizontal">
            <input id="token" type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <input id="token" type="hidden" name="id" value="{{$cotizacion->id}}">

                <div class="form-group">
            <label class="col-sm-2 control-label" for="inputnombrep"> Para: </label>
              <div class="col-sm-7">
              <input type="text" class="form-control" name="para" id="para" readonly value=" {{$clientes->email}}">
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
                  <input type="text" required class="form-control" name="asunto" id="asunto">
                </div>
          </div> 

           <div class="form-group">
            <label class="col-sm-2 control-label" for="inputimagen"> Mensaje: </label>
              <div class="col-sm-7">
                <textarea required class="form-control autosize area-animated" name="mensaje" id="mensaje" data-autosize-on="true" style="overflow: hidden; resize: horizontal; word-wrap: break-word; height: 71px;"></textarea>
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