@extends("dashboard.layouts.default")

@section('title')
	Cotización
@stop

@section("css")
@stop

@section("pagina")
	<h2>Cotización</h2>
@stop

@section("contenido")


@if($restric >= 3 or $resultado->role_id==1)

 <div class="alert alert-warning">Ya puede realizar cotizaciones...</div>

  <fieldset>
  	<a href="{{URL::route('cotizacionForm')}}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva Cotización</a>
  </fieldset>

	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Código</th>
			<th>Fecha</th>
			<th>Cliente</th>
			<!--<th>Articulo</th>			
			<th>Cantidad</th>-->
			<th>Monto Total</th>
			<!--<th>Tipo impresion</th>
			<th>Costo impresion</th>-->
			<th>status</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
	 @foreach($cotizacion as $cotiza)
	 	<tr>
	 		<td>{{$cotiza->id}}</td>
	 		<td>
	 			<?php $date = date_create($cotiza->created_at); ?>
	 			{{date_format($date,"d-m-Y H:i:s")}}
	 		</td>
                <td>{{$cotiza->nombre}}</td>
	 		<td>$ {{number_format($cotiza->total,2,".",",")}}</td>
			<td>
				@if($cotiza->status == 1)
					Pendiente
				@endif
				@if($cotiza->status == 2)
					Pedida
				@endif
				@if($cotiza->status == 3)
					 Enviada
				@endif
				@if($cotiza->status == 4)
					Enviada
				@endif
			</td>
	 		<td width="2%" align="center">
				@if($cotiza->status == 3)
	 			<a href="{{URL::route('cotizacionPedirForm')}}/{{$cotiza->id}}" class="btn btn-dark-green btn-xs"><i class="ti-shopping-cart"></i> Pedir</a>
				@endif
	 			</td>
	  			<td width="2%" align="center"><a href="{{URL::route('cotizacionMostrarForm')}}/{{$cotiza->id}}" class="label label-primary"><i class="fa fa-search"></i></a></td>
	 			<td width="2%" align="center">
					@if($cotiza->status != 4)
	 				<a href="{{URL::route('articulos.cotizacion')}}/{{$cotiza->id}}" class="label label-warning"><i class="fa fa-pencil"></i></a>
					@endif
	 			</td>
	 			<td width="2%" align="center"><a href="{{URL::route('cotizacionEliminar')}}/{{$cotiza->id}}" class="label label-danger" onclick="return confirm('¿Eliminar?')"><i class="fa fa-trash-o"></i></a></td>
	 	</tr>
	 @endforeach
	  </tbody>		
	</table>


  @else


 <div class="alert alert-warning">Prospectos enviados: {{$restric}} 

<p>Para realizar las cotizaciones debe enviar los tres (3) prospectos</p>

 </div>	
 
 @endif
  
@stop
@section("js")
@stop