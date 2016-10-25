<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
<style type="text/css">
body,html {
  font-family: sans-serif;
}
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
.tabla {
  border: 0px;
  border-collapse: collapse;
}
table.tabla {
  border: 0px;
  /*text-align: justify;*/
}
</style>
</head>
<body>
			<img src="{{asset('uploads/promosmile.png')}}" width="210px" />

			<br><br>

           <p id="p"><h4>Smile Promotional Solutions, S.A. de C.V.</h4></p>
           <p id="p">Bosque de Duraznos No. 67 Interior 101B  </p>
           <p id="p"> Bosques de las Lomas, Miguel Hidalgo </p>
           <p id="p">Distrito Federal, C.P. 11700 </p>
           <p id="p">RFC:SPS121113BK7</p>
           <p></p>

 <table  style="position:absolute;top:60px;left:440px;" width="250px"  border="0" cellspacing="0" cellpadding="2" >

 				<tr style="border:0px;"><th colspan="2" style="border:0px;"><h3 style="border:0px;">Orden de Compra</h3></th></tr>
              <tr bgcolor="#C8C9CB"><th style="border:1px solid;">Folio</th><th style="border:1px solid;">Fecha</th></tr>
               <tr>
                <th style="border:1px solid;">{{$compras[0]['id']}}</th>
                <?php  
                  $date = date_create($compras[0]['created_at']); 
                ?>
                <th style="border:1px solid;">{{date_format($date,"d-m-Y")}}</th></tr>
               


            </table>


  <table  style="position:absolute;top:280px;left:0px;" width="300px"  border="1" cellspacing="0" cellpadding="2" >

<tr bgcolor="#C8C9CB"><th><h3>Datos del Proveedor</h3></th></tr>
 				<tr><td><p id="p">Proveedor: 00{{$proveedor->id}}</p>
                  <p id="p"><strong>{{$proveedor->nombre}}</strong></p>
                  <p id="p">Colonia {{$proveedor->colonia}} C.P. {{$proveedor->cp}}, {{$proveedor->municipio}}</p>
                  <p id="p">RFC: {{$proveedor->rfc}}</p>


                  </td></tr>

            </table>


<table  style="position:absolute;top:280px;left:425px;" width="300px"  border="1" cellspacing="0" cellpadding="2" >

<tr bgcolor="#C8C9CB"><th><h3>Enviar a:</h3></th></tr>
 				 <tr style="font-size:12px;"><td><h5 id="p">
                 <p style="text-align:left;margin:1px;">Almacén: {{$compras[0]['nombre']}} Contacto: {{$compras[0]['persona_contacto']}}</p>
                  <p style="text-align:left;margin:1px;">Pais: {{$compras[0]['pais']}} Municipio: {{$compras[0]['municipio']}}Colonia: {{$compras[0]['colonia']}}</p>
                  <p style="text-align:left;margin:1px;">Calle:{{$compras[0]['calle']}} No. interior {{$compras[0]['numinterior']}} C.P. {{$compras[0]['cp']}}</p>
                  <p style="text-align:left;margin:1px;">TLF. {{$compras[0]['telefono']}} E-mail: {{$compras[0]['email']}}</p>
                        </h5></td></tr>

            </table>



  <table class="tabla" style="position:absolute;top:430px;left:0px;"  width="100%">

        <tr bgcolor="#C8C9CB" >
            <th style="border: 1px solid;">Codigo</th>
            <th style="border: 1px solid;">Descripción</th>
            <th style="border: 1px solid;">Cantidad</th>
            <th style="border: 1px solid;">Color</th>
            <th style="border: 1px solid;">Precio Unitario</th>
            <th style="border: 1px solid;">Subtotal</th>
        </tr>
        <?php $total = 0; ?>
        @foreach($articulos as $c)
          <tr >
            <td  style="border: 1px solid;" id="c" >{{$c['id']}}</td>
            <td  style="border: 1px solid;"id="c">{{$c['descripcion']}}</td>
            <td  style="border: 1px solid;" id="c">{{$c['cantidad']}}</td>
            <td  style="border: 1px solid;" id="c">{{$c['color']}}</td>
            <td  style="border: 1px solid;" id="c">$ {{number_format($c['costo_unitario'],2,".",",")}}</td>      
            <td  style="border: 1px solid;" style="border-bottom:0px;" id="c">$ {{number_format($c['costo_unitario']*$c['cantidad'],2,".",",")}}</td>
          </tr>
          <?php $total += ($c['costo_unitario']*$c['cantidad']);?>
        @endforeach
          <tr >
            <td style="border: 1px solid;text-align:center;" colspan="4" bgcolor="#C8C9CB">Observaciones</td>
            <td style="border: 1px solid;text-align:center;" bgcolor="#C8C9CB">Subtotal</td>
            <td style="border: 1px solid;text-align:center;" >$ {{number_format($total,2,".",",")}} </td>
           </tr>
            <tr >
              <td style="border: 1px solid;text-align:justify;" rowspan="2" colspan="4" >{{$compras[0]['observaciones']}}</td>
              <td style="border: 1px solid;text-align:center;" bgcolor="#C8C9CB">IVA</td>
              <td style="border: 1px solid;text-align:center;">$ {{number_format($total*0.16,2,".",",")}} </td>
           </tr>

           <tr>
              <td style="border: 1px solid;text-align:center;" bgcolor="#C8C9CB">Total</td>
              <td style="border: 1px solid;text-align:center;">$ {{number_format($total+($total*0.16),2,".",",")}}</td>
           </tr>


 </table>

<table style="position:absolute;top:890px;left:0px;" width="100%"   >
<tr><th>
<p>____________________________</p>
<p id="a">Autoriza</p>
<p id="a">{{Auth::user()->username}} </p>
</th></tr>
 </table>
</body>
</html>