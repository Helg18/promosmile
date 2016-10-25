@extends("dashboard.layouts.default")

@section("title")
	Articulos Cotización
@stop

@section("css")
@stop

@section("pagina")
	Articulos Cotización
@stop

@section("contenido")
	<table class="table">
		<tr>
			<th>
				Codigo
			</th>
			<th>
				Articulo
			</th>
			<th>
				Imagen
			</th>
			<th>
				Cantidad
			</th>
			<th>
				Precio unitario
			</th>
			<th>
				Total
			</th>
			<th>
				Opciones
			</th>
		</tr>
		<?php $total = 0; ?>
		@foreach($articulos as $a)
		<tr>
			<td>
				{{$a->id}}
			</td>
			<td>
				{{$a->nombre}}
			</td>
			<td></td>
			<td>
				{{$a->cantidad}}
			</td>
			<td>
				$ {{number_format($a->precio_unitario,2,".",",")}}
			</td>
			<td>
				$ {{number_format($a->total,2,".",",")}}
			</td>
			<td>
				<a href="{{URL::route('cotizacionEditarForm')}}/{{$a->id}}" class="label label-warning" align="center">
					<i class="fa fa-pencil" align="center"></i>
				</a>
			</td>
		</tr>
		<?php $total += $a->total; ?>
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>$ {{number_format($total,2,".",",")}}</td>
			<td></td>
		</tr>
	</table>
	<br>
	<a class="btn btn-warning pull-right"  href="{{URL::route('cotizacion')}}" >Regresar</a>

@stop

@section("js")
@stop