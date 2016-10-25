@extends("dashboard.layouts.default")

@section('title')
	Pedidos recibidos
@stop

@section("css")
	
@stop

@section("pagina")
	<h2>Pedidos recibidos</h2>
@stop

@section("contenido")
 
	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Codigo</th>
			<th>Proveedor</th>
			<th>Cliente</th>
			<th>Vendedor</th>
			<!--<th>Articulo</th>-->
			<!--<th>Cantidad</th>-->
			<th>Fecha de entrega</th>
			<th>Monto Total</th>
			<th>Pagado</th>
			<th>Deuda</th>
			<th>Asignar fecha</th>		
		</tr>
		</thead>
		<tbody>
	 @foreach($compras as $compra)
	 	@if($compra->status != 6)
	 	<tr>
	 		<td>{{$compra->id}}</td>
	 		<td>{{$compra->pn}}</td>
	 		<td>{{$compra->cn}}</td>
	 		<td>{{$compra->vn}}</td>
	 		
	 		<td>
	 			@if($compra->fecha_entrega > 0)
	 				<?php $date =  date_create($compra->fecha_entrega); ?>	
	 				{{date_format($date,"d-m-Y")}}
	 			@else
	 				{{$compra->fecha_entrega}}
	 			@endif
	 		</td>
	 		<td>$ {{number_format($compra->totala*$compra->can,2,".",",")}}</td>
	 		<td>
	 			$ {{number_format($compra->pagado,2,".",",")}}
	 		</td>
	 		<td>$ {{number_format(($compra->totala*$compra->can)-$compra->pagado,2,".",",")}}</td>
	 		<td>
	 			@if(number_format(($compra->totala*$compra->can)-$compra->pagado,2,".",",") > 0)
	 			<a href="{{URL::route('entregasFechaForm')}}/{{$compra->id}}" class="label label-success">Asignar fecha</a>
	 			@else
	 			 <span class="label label-primary">Pagado</span>
	 			@endif
	 		</td>
			
	 	</tr>
	 	@endif
	 @endforeach
	  </tbody>		
	</table>
 
@stop

@section("js")
	
@stop