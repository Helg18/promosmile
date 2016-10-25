<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Orden de Compra</title>

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
  line-height: 10%; font-size: 0.9em;
}

#a{
  text-align: center;
  line-height: 10%; font-size: 0.9em;
}

#c{

text-align: center;

}
</style>

</head><body>


			<img src="{{asset('uploads/promosmile.png')}} " /> 

			<br><br>

           <p id="p"><h4>Smile Promotional Solutions, S.A. de C.V.</h4></p>
           <p id="p">Bosque de Duraznos No. 67 Interior 101B  </p>
           <p id="p"> Bosques de las Lomas, Miguel Hidalgo </p>
           <p id="p">Distrito Federal, </p>
           <p id="p">C.P. 11700 </p>
           <p id="p">RFC:SPS121113BK7</p>

 <table  style="position:absolute;top:50px;left:440px;" width="250px"  border=1 cellspacing=0 cellpadding=2 >

 				<tr><th colspan="2"><h3>Orden de Compra</h3></th></tr>
              <tr bgcolor="#C0C0C0"><th>Folio</th><th>Fecha</th></tr>
               <tr><th>{{$c->id}}</th><th>{{$c->fecha}}</th></tr>
               <tr><th colspan="2" bgcolor="#C0C0C0">Condicines de Pago</th></tr>
               <tr><th colspan="2"><br></th></tr>


            </table>


  <table  style="position:absolute;top:250px;left:0px;" width="300px"  border=1 cellspacing=0 cellpadding=2 >

<tr bgcolor="#C0C0C0"><th><h3>Datos del Proveedor</h3></th></tr>
 				<tr><td><p id="p">Proveedor: 00 {{$proveedor->id}}</p>
                  <p id="p"><strong>{{$proveedor->nombre}}</strong></p>
                  <p id="p">Colonia {{$proveedor->colonia}} C.P. {{$proveedor->cp}} {{$proveedor->municipio}}</p>
                  <p id="p">RFC: {{$proveedor->rfc}} </p>


                  </td></tr>

            </table>


<table  style="position:absolute;top:250px;left:425px;" width="300px"  border=1 cellspacing=0 cellpadding=2 >

<tr bgcolor="#C0C0C0"><th><h3>Enviar a:</h3></th></tr>
 				 <tr style="font-size:12px;"><td><h5 id="p">
                 <p style="text-align:left;margin:1px;">Almacén: {{$almacen->nombre}} Contacto: {{$almacen->persona_contacto}}</p>
                  <p style="text-align:left;margin:1px;">Pais: {{$almacen->pais}} Municipio: {{$almacen->municipio}} Colonia: {{$almacen->colonia}}</p>
                  <p style="text-align:left;margin:1px;">Calle: {{$almacen->calle}} No. interior {{$almacen->numinterior}} C.P. {{$almacen->cp}}</p>
                  <p style="text-align:left;margin:1px;">TLF. {{$almacen->telefono}} E-mail: {{$almacen->email}}</p>
                        </h5></td></tr>

            </table>



  <table style="position:absolute;top:410px;left:0px;" width="100%"   border=1 cellspacing=0 cellpadding=2 >

        <tr bgcolor="#C0C0C0">
            <th>Codigo</th>
              <th>Descripción</th>
                  <th>Cantidad</th>
                   <th>Color</th>
                    <th>Precio Unitario</th>
                     <th>Descuento</th>
                       <th>Subtotal</th>



        </tr>


        <tr valign="top">
            <td id="c" HEIGHT="170">{{$c->id}}</td>
              <td id="c">{{$c->descripcion}}</td>
                  <td id="c">{{$c->cantidad}}</td>
                       <td id="c">{{$c->color}}</td>
                    <td id="c">$ {{$c->precio_unitario}}</td>
                      <td id="c">$ {{$descuento}}</td>
                      <td id="c">$ {{$c->subtotal_descuento}} </td>






          <tr>
            <th colspan="5" bgcolor="#C0C0C0"><h4>Observaciones</h4></th>
              <th bgcolor="#C0C0C0"><h4>Subtotal</h4></th>
                <th><h4>$ {{$c->subtotal_descuento}} </h4></th>

           </tr>

            <tr>
            <th colspan="5"><p id="p">{{$c->observaciones}} </p></th>
              <th bgcolor="#C0C0C0"><h4>Iva</h4></th>
                <th><h4>$ {{$c->iva}} </h4></th>

           </tr>

           <tr>
            <td colspan="5"><h4 id="th"></h4></td>
              <td bgcolor="#C0C0C0"><h4 id="th">Total</h4></td>
                <td><h4 id="td">$ {{$c->total}}</h4></td>

           </tr>


 </table>

<table style="position:absolute;top:890px;left:0px;" width="100%"   >
<tr><th>
<p>____________________________</p>
<p id="a">Autoriza</p>
<p id="a">Jacobo Laniado Betech </p>
</th></tr>
 </table>

 </body>
</html>
