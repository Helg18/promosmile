<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Document</title>
	   
 <style type="text/css">


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
  line-height: 10%; font-size: 0.8em; 
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
color: white; 

} 

.ti{

text-align: center;
color: white; 
font-size: 28px;
}

.tam{

text-align: center;
color: white; 
font-size: 20px;
font-weight: bold;
}

</style>
</head>
<body>
	<img src="{{asset('uploads/promosmile.png')}} " /> 

			<br><br>

           <p id="p"><h4>Smile Promotional Solutions, S.A. de C.V.</h4></p>
           <p id="p">Bosque de Duraznos No. 67 Interior 101B  </p>
           <p id="p"> Bosques de las Lomas, Miguel Hidalgo </p>
           <p id="p">Distrito Federal, </p>
           <p id="p">C.P. 11700 </p>
           <p id="p">RFC:SPS121113BK7</p>

 <table  style="position:absolute;top:50px;left:440px;" width="250px" border=1 cellspacing=0 cellpadding=2   >

 				   <tr><th colspan="2"><h3>Cotización</h3></th></tr>
              <tr bgcolor="27BF2F"><td class="e">Folio</td><td class="e">Fecha</td></tr>
               <tr id="th"><th id="th">{{$venta->id }}</th><th>{{$venta->fecha }}</th></tr>
               
            </table>


  <table  style="position:absolute;top:250px;left:0px;" width="100%"  border=1 cellspacing=0 cellpadding=2 >

<tr bgcolor="#e35416"><th class="ti" colspan="2">Datos del Cliente</th></tr>
 			
 					
 				<tr><td style="border:none;">Nombre: {{$cliente->persona_contacto}} </td>  	


 					<td style="border:none;">Empresa: {{$cliente->nombre}} </td></tr>


 					<tr><td style="border:none;"><br></td>  	


 					   <td style="border:none;"><br></td></tr>



 					<tr><td style="border:none;">E-mail: {{$cliente->email}}</td>  	


 					   <td style="border:none;">Teléfono: {{$cliente->telefono}} </td></tr>

 					   <tr><td style="border:none;"><br></td>  	


 					   <td style="border:none;"><br></td></tr>

	

            </table>


  <table style="position:absolute;top:400px;left:0px;" width="100%"   border=1 cellspacing=0 cellpadding=2 >
       
        <tr bgcolor="27BF2F">
            <th class="e">Codigo</th>
              <th class="e">Descripción</th>
                <th class="e">Imagen</th>
                  <th class="e">Cantidad</th>
                    <th class="e">Precio Unitario</th>
                     <th class="e">Descuento</th>
                       <th class="e">Subtotal</th>



        </tr>


        <tr valign="top">
            <td id="c"  HEIGHT="240">{{$venta->id }}</td>
              <td id="c">{{$venta->descripcion}}</td>
                    <td id="c"><img width="100px" height="100px" src="{{asset('uploads/images/'.$imagen->filename)}} "/></td>
                  <td id="c">{{$venta->cantidad }}</td>
                    <td id="c">$ {{number_format($venta->precio_unitario, 2, ",", ".") }}</td>
                       <td id="c">$ {{number_format($venta->subtotal - $venta->subtotal_descuento, 2, ",", ".")}} </td>
                         <td id="c">$ {{number_format($venta->subtotal_descuento, 2, ",", ".") }}</td>



        </tr>

       

     
          <tr>
            <th colspan="5" bgcolor="#e35416" class="tam">Observaciones</th>
              <th bgcolor="#27BF2F" class="tam">Subtotal</th>
                <th>$ {{number_format($venta->subtotal_descuento, 2, ",", ".") }}</th>
               
           </tr>

            <tr>
            <th colspan="5"><p id="p">{{$venta->observaciones }}</p></th>
              <th bgcolor="#e35416" class="tam">Iva</th>
                <th>$ {{number_format($venta->iva, 2, ",", ".") }}</th>
               
           </tr>

           <tr>
            <td colspan="5"></td>
              <td bgcolor="#27BF2F" class="tam">Total</td>
                <th>$ {{number_format($venta->total, 2, ",", ".") }}</th>
               
           </tr>
 

 </table>

<table style="position:absolute;top:860px;left:0px;" width="100%"   >
<tr><td>

 <p id="p">*Existencia en constante movimiento, el precio podría variar sin previo aviso. </p>
 <p id="p">*La cotización es válida  hasta 8 días posterior a la fecha del documento. </p>
 <p id="p">*Las condiciones de pago son 50% anticipo y 50% contra entrega. </p>
 <p id="p">*El tiempo de entrega es de 6 a 8 días hábiles. </p>
 <p id="p">*Contamos con entregas urgentes, sin embargo, Promosmile no se hace responsable por cualquier defecto en pedidos de carácter </p>
 <p id="p">urgente. </p>
 <p id="p">*Una vez autorizado el pedido no se aceptan cancelaciones ni cambios, de ser así, el costo generado correrá por cuenta del cliente.</p> 
 <p id="p">*La entrega de la mercancía está incluida en el precio, siempre y cuando rebase los $3,000.00 (Tres mil pesos 00/100 MN)</p>
 <p id="p">antes de IVA   y sea dentro del Distrito Federal y Área Metropolitana, de lo contrario favor de consultarlo con su ejecutivo.</p>

</td></tr>
 </table>
</body>
</html>