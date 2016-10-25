@extends("dashboard.layouts.default")

@section('title')
	Cuentas por cobrar
@stop

@section("css")
@stop

@section("pagina")
	<h2>Cuentas por cobrar</h2>
@stop

@section("contenido")

  <fieldset>

	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Código</th>
			<th>Fecha</th>
			<th>Cliente</th>
			<th>Monto Total</th>
			<th>Pagado</th>
			<th>Deuda</th>
			<th>Pagar</th>
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
				$ {{number_format($cotiza->pagado,2,".",",")}}
			</td>
			<td>
				$ {{number_format($cotiza->total-$cotiza->pagado,2,".",",")}}
			</td>
			<td>
				
				@if(number_format($cotiza->total-$cotiza->pagado,2) > 0)
				<a href="{{URL::route('cuentaCobrarForm')}}/{{$cotiza->id}}" class="label label-success">Pagar</a>
				@else
					<span class="label label-primary">Pagado</span>
				@endif
			</td>
				
	 	</tr>
	 @endforeach
	  </tbody>		
	</table>
  
@stop
@section("js")
@stop