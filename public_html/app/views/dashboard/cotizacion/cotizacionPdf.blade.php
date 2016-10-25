<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
<style type="text/css">
body,html {
  font-family: sans-serif;
}
.th{
  color: black;
  text-align: center;
}


#td{
  color: black;
  text-align: center;
  
}

#f{
  color: black;
  
}



#p2{

  color: black;
  text-align: justify;
  line-height: 10%; font-size: 0.8em; 
}
#p{
  width: 100%;
  font-size: 12px;
  color: black;
  text-align: justify;
  white-space: pre-line;
  margin: .1em;
  margin-right: 50px;
  margin-left:  -30px;
}
#a{
  text-align: center;
  line-height: 10%; font-size: 0.9em; 
}

#c{
text-align: center;

}
.e { 
text-align: center;
border-bottom-color:white;
} 

.e2{
border:1px solid black;
border-bottom-color:white;
}

.e3{
border:1px solid black;
border-top-color:white;
}

.ti{

text-align: center;
 
font-size: 28px;
}

.tam{

text-align: center;
font-size: 20px;
}

</style>

</head>
<body>
      <?php 
        $count = 0; 
        $mar   = 500;
      ?>            
      <img  width="210px"  src="{{asset('uploads/promosmile.png')}}" /> 
      <br><br>

           <p id="p2"><h4>Smile Promotional Solutions, S.A. de C.V.</h4></p>
           <p id="p2">Bosque de Duraznos No. 67 Interior 101B  </p>
           <p id="p2"> Bosques de las Lomas, Miguel Hidalgo </p>
           <p id="p2">Distrito Federal, C.P. 11700 </p>
           <p id="p2">RFC:SPS121113BK7</p>

 <table  style="position:absolute;top:50px;left:440px;" width="250px"  border="0" cellspacing="0" cellpadding="2" >

        <tr><th colspan="2"><h3>Cotización</h3></th></tr>
            <tr bgcolor="26AD49" >
              <td class="e2" style="text-align:center;">
                <span style="color:white;">Folio</span>
              </td>
              <td class="e2" style="text-align:center;">
                <span style="color:white;">Fecha</span>
              </td>
            </tr>
              <tr id="th">
                <th class="e3" id="th" style="font-weight:normal;" >{{$cotizacion->id}}</th>
                <?php 
                  $date = date_create($cotizacion->fecha);
                 ?>
                <th class="e3" style="font-weight:normal;">{{date_format($date,"d-m-Y")}}</th>
              </tr>
               
            </table>


  <table  style="position:absolute;top:280px;left:0px;border: solid 1px black;" width="100%"   cellspacing="0" cellpadding="2" >

<tr bgcolor="#F26923"><th class="ti" colspan="2" > <span style="color:white;">Datos del Cliente</span></th></tr>
      
          
        <tr><td style="border:none;padding-left:10px;">Nombre: {{$cliente->persona_contacto}} </td>    


          <td style="border:none;">Empresa:  {{$cliente->nombre}} </td></tr>


          <tr><td style="border:none;"><br></td>    


             <td style="border:none;"><br></td></tr>



          <tr><td style="border:none; padding-left:10px;">E-mail: {{$cliente->email}} </td>    


             <td style="border:none;">Teléfono: {{$cliente->telefono}}  </td></tr>

             <tr><td style="border:none;"><br></td>   


             <td style="border:none;"><br></td></tr>

  

            </table>


  <table style="position:absolute;top:400px;left:0px;" width="100%"    cellspacing="0" cellpadding="2" >
       
        <tr bgcolor="26AD49">
            <th class="e" style="border:solid 1px;"><span style="color:white;">Codigo</span></th>
              <th class="e" style="border:solid 1px;"><span style="color:white;">Descripción</span></th>
              <th class="e" style="border:solid 1px;"><span style="color:white;">Color</span></th>
                <th class="e" style="border:solid 1px;"><span style="color:white;">Imagen</span></th>
                  <th class="e" style="border:solid 1px;"><span style="color:white;">Cantidad</span></th>
                    <th class="e" style="border:solid 1px;"><span style="color:white;">Precio <br>Unitario</span></th>
                     
                       <th  class="e" style="width:100px;border:solid 1px;" ><span style="color:white;">Total</span></th>



        </tr>

        <?php 
          $sub = 0; 
          $pp  = 0;
        ?>
        @foreach($ca as $c)
        <?php  $count++;?>
        <tr>
            <td style="border:solid 1px;"><h5 id="td" style="font-weight:normal;">{{$c->id}}</h5></td>
              <td style="border:solid 1px;">
                <h5 id="td" style="font-weight:normal;">
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
              <td style="border:solid 1px;">
                <h5 id="td" style="font-weight:normal;">
                  <?php 
                    //$s   = str_replace(",", "<br>", $c->color); 
                    $val = floatval(substr(strstr($c->color,":"),1));
                    $co  = strstr($c->color,":",true);   
                  ?>
                  {{$co.":".number_format($val,2)."<br>"}}
                </h5>
              </td>
                 
                  <td style="border:solid 1px;"><h5 id="td" style="font-weight:normal;"><img width="150px" height="120px" src="{{$c->imagen}}"/></h5></td>
                  <td style="border:solid 1px;"><h5 id="td" style="font-weight:normal;">{{number_format($c->cantidad,2)}}</h5></td>
                    <td style="border:solid 1px;">
                      <h5 id="td" style="font-weight:normal;">
                        $ {{number_format(($c->precio_unitario+$c->costoimpresion), 2, ".", ",")}}
                        
                      </h5>
                    </td>
                      
                       <td style="border:solid 1px;"><h5 id="td" style="font-weight:normal;">$ {{number_format($c->total, 2, ".", ",")}}</h5></td>
        </tr>
        @if($c->placas > 0)
            <tr style="text-align:center;">
              <td ></td>
              <td style="font-weight:normal;">Placas</td>
              <td ></td>
              <td ></td>
              <td style="font-weight:normal;">{{$c->placas}}</td>
              <td ></td>
              <?php $pp += ($c->placas*150); ?>
              <td style="font-weight:normal;">${{number_format($c->placas*150,2,".",",")}}</h5></td>
            </tr>
        @endif
        <?php  $sub += $c->total;?>
      @endforeach
       

     
           <tr>
            <td  colspan="5" bgcolor="#F26923" class="tam" style="border:solid 1px;">
              <span style="color:white;">Observaciones</span>
            </td>
            <?php $t = $sub + $pp; ?>
              <td bgcolor="#26AD49" class="tam"><span style="color:white;">Subtotal</span></td>
                <td class="" style="font-size:12px;text-align:center;border:solid 1px;">$ {{number_format($t, 2, ".", ",")}}</td>
           </tr>

            <tr style="border:0px;">
            <td  rowspan="2" colspan="5" style="border:solid 1px;">
              <p id="p2">{{$cotizacion->observaciones}}</p>
            </td>
            <td bgcolor="#F26923" class="tam" style="border:0px;"><span style="color:white;">IVA</span></td>
            <td  style="font-size:12px;text-align:center;border:solid 1px;">$ {{number_format($t*0.16, 2, ".", ",")}}</td> 
           </tr>

           <tr >
              
              <td bgcolor="#26AD49" class="tam" style="border-bottom:solid 1px;"><span style="color:white;">Total</span></td>
              <td  style="font-size:12px;text-align:center;border:solid 1px;">$ {{number_format($t+($t*0.16), 2, ".", ",")}}</td> 
           </tr>
 </table>
@if($count >= 2) 
<span style='page-break-after:always'></span>
<?php $mar = 0; ?>
@endif
<table style="margin-top:{{$mar}}px;">
<tr>
  <td>

 <p id="p">*Existencia en constante movimiento, el precio podría variar sin previo aviso. </p>
 <p id="p">*La cotización es válida  hasta 8 días posterior a la fecha del documento. </p>
 <p id="p">*Las condiciones de pago son 50% anticipo y 50% contra entrega. </p>
 <p id="p">*El tiempo de entrega es de 6 a 8 días hábiles. </p>
 <p id="p">*Contamos con entregas urgentes, sin embargo, Promosmile no se hace responsable por cualquier defecto en pedidos de carácter urgente. </p>
 <p id="p">*Una vez autorizado el pedido no se aceptan cancelaciones ni cambios, de ser así, el costo generado correrá por cuenta del cliente.</p> 
 <p id="p">*La entrega de la mercancía está incluida en el precio, siempre y cuando rebase los $3,000.00 (Tres mil pesos 00/100 MN)</p>
 <p id="p">antes de IVA   y sea dentro del Distrito Federal y Área Metropolitana, de lo contrario favor de consultarlo con su ejecutivo.</p>

</td>
</tr>
 </table>

</body>
</html>