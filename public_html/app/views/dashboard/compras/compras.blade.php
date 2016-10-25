@extends("dashboard.layouts.default")

@section('title')
	Pedidos
@stop

@section("css")
@stop

@section("pagina")
	<h2>Pedidos</h2>
@stop

@section("contenido")
  <!--<fieldset>
  	<a href="{{URL::route('comprasForm')}}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Pedido</a>
  </fieldset>-->


@if($resultado->role_id==1)
	<h3>Pedidos en proceso</h3>
	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Codigo</th>
			<th>Cotización</th>
			<th>Proveedor</th>
			<th>Cliente</th>
			<th>Almacen</th>
			<th>Vendedor</th>
			<!--<th>Articulo</th>-->
			<!--<th>Cantidad</th>-->
			<th>Monto Total</th>
			<th>Archivos</th>
			<th>Logotipo</th>
			<th>Fecha de Registro</th>
			<th>status</th>			
			<!--<td></td>-->
			<th></th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
	 @foreach($compras as $compra)
	 	@if($compra->status != 6)
	 	<tr>
	 		<td>{{$compra->id}}</td>
	 		<td><a class="btn btn-primary" href="{{URL::route('cotizacionMostrarForm')}}/{{$compra->cotizacion}}">{{$compra->cotizacion}}</a></td>
	 		<td>{{$compra->pn}}</td>
	 		<td>{{$compra->cn}}</td>
	 		<td>
	 			{{$compra->almacen_nombre }}
	 		</td>
	 		<td>{{$compra->vn}}</td>
	 		<td>$ {{number_format($compra->totala*$compra->can,2,".",",")}}</td>
	 		<td>
	 			@if($compra->orden != null)
	 				<a target="_blank" href="{{URL::route('mostrarOrden')}}/{{$compra->id}}">Orden</a><br>
	 			@endif
	 			@if($compra->anticipo != null)
	 				<a target="_blank" href="{{URL::route('mostrarAnticipo')}}/{{$compra->id}}">Anticipo</a>
	 			@endif
	 		</td>
	 		<td>
	 			<a href="{{URL::route('logotipo')}}/{{$compra->id}}">
	 				@if(Logotipos::where("pedido_id","=",$compra->id)->count() > 0)
	 					Ver logotipo
	 				@else
	 					Adjuntar logotipo
	 				@endif
	 			</a>
	 		</td>
	 		<td>
	 			<?php $date = date_create($compra->created_at); ?>	
	 			{{date_format($date,"d-m-Y H:i:s")}}
	 		</td>
	 		<td>
	 			@if($compra->status == 1 || $compra->status == 2)
					Pendiente
	 			@endif
	 			@if($compra->status == 3)
					Comprado
	 			@endif
	 			@if($compra->status == 4)
					Recibido
	 			@endif
	 			@if($compra->status == 5)
					Maquila
	 			@endif
	 			@if($compra->status == 6)
					Entregado
	 			@endif
	 		</td>
			<td>
				@if($compra->status == 1)
				<a href="{{URL::route('cotizacionCompraForm')}}/{{$compra->id}}" class="btn btn-success btn-xs"> Comprar</a>
				@endif
				@if($compra->status == 3)
				<a href="{{URL::route('comprasRecibir')}}/{{$compra->id}}" class="btn btn-warning btn-xs"> Recibir</a>
				@endif
				@if($compra->maquila_status == 1)
	 			<a href="{{URL::route('comprasMaquilarForm')}}/{{$compra->id}}" class="btn btn-green btn-xs"> Maquilar</a>
				@endif
				@if($compra->status == 4 && $compra->maquila_status != 1)
				<a href="{{URL::route('comprasEntregado')}}/{{$compra->id}}" class="btn btn-primary btn-xs"> Entregado</a>
				@endif
			</td>
	  		<td width="1%" align="center">
	  			@if($compra->status >= 2)
	  			<a href="{{URL::route('comprasMostrarForm')}}/{{$compra->id}}" class="label label-primary">
	  			<i class="fa fa-search"></i> Ver</a>
	  			@endif
	  		</td>
	 		<td width="1%" align="center"><a href="{{URL::route('comprasEliminar')}}/{{$compra->id}}" class="label label-danger" onclick="return confirm('¿Eliminar?')"><i class="fa fa-trash-o"></i> Eliminar</a></td>
	 	</tr>
	 	@endif
	 @endforeach
	  </tbody>		
	</table>
 
 <h3>Pedidos finalizados</h3>
	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th width="7%">Codigo</th>
			<th width="7%">Cliente</th>
			<th width="7%">Almacen</th>
			<th width="7%">Vendedor</th>
			<!--<th>Articulo</th>-->
			<!--<th>Cantidad</th>-->
			<th width="7%">Monto Total</th>
			<th width="7%">Archivos</th>
			<th width="7%">Fecha de Registro</th>
			<th width="7%">status</th>			
			<!--<td></td>-->
			<th width="7%"></th>
			<th width="7%"></th>
			<th width="7%"></th>
		</tr>
		</thead>
		<tbody>
	 @foreach($compras as $compra)
	 	@if($compra->status == 6)
	 	<tr>
	 		<td>{{$compra->id}}</td>
	 		<td>{{$compra->cn}}</td>
	 		<td>{{$compra->almacen_nombre}}</td>
	 		<td>{{$compra->vn}}</td>
	 		<td>$ {{number_format($compra->totala*$compra->can,2,".",",")}}</td>
	 		<td>
	 			@if($compra->orden != null)
	 				<a target="_blank" href="{{URL::route('mostrarOrden')}}/{{$compra->id}}">Orden</a><br>
	 			@endif
	 			@if($compra->anticipo != null)
	 				<a target="_blank" href="{{URL::route('mostrarAnticipo')}}/{{$compra->id}}">Anticipo</a>
	 			@endif
	 		</td>
	 		<td>
	 			<?php $date = date_create($compra->created_at); ?>	
	 			{{date_format($date,"d-m-Y H:i:s")}}
	 		</td>
	 		<td>
	 			@if($compra->status == 1 || $compra->status == 2)
					Pendiente
	 			@endif
	 			@if($compra->status == 3)
					Comprado
	 			@endif
	 			@if($compra->status == 4)
					Recibido
	 			@endif
	 			@if($compra->status == 5)
					Maquila
	 			@endif
	 			@if($compra->status == 6)
					Entregado
	 			@endif
	 		</td>
			<td>
				@if($compra->status == 1)
				<a href="{{URL::route('cotizacionCompraForm')}}/{{$compra->id}}" class="btn btn-danger btn-xs"> Comprar</a>
				@endif
				@if($compra->status == 3)
				<a href="{{URL::route('comprasRecibir')}}/{{$compra->id}}" class="btn btn-warning btn-xs"> Recibir</a>
				@endif
				@if($compra->status == 4)
	 			<a href="{{URL::route('comprasMaquilarForm')}}/{{$compra->id}}" class="btn btn-green btn-xs"> Maquilar</a>
				@endif
				@if($compra->status == 5)
				<a href="{{URL::route('comprasEntregado')}}/{{$compra->id}}" class="btn btn-primary btn-xs"> Entregado</a>
				@endif
			</td>
	  		<td width="1%" align="center">
	  			@if($compra->status >= 2)
	  			<a href="{{URL::route('comprasMostrarForm')}}/{{$compra->id}}" class="label label-primary">
	  			<i class="fa fa-search"></i> Ver</a>
	  			@endif
	  		</td>
	 		<td width="1%" align="center"><a href="{{URL::route('comprasEliminar')}}/{{$compra->id}}" class="label label-danger" onclick="return confirm('¿Eliminar?')"><i class="fa fa-trash-o"></i> Eliminar</a></td>
	 	</tr>
	 	@endif
	 @endforeach
	  </tbody>		
	</table>
@else
<h3>Pedidos en proceso</h3>
	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Codigo</th>
			<th>Cotización</th>
			<th>Proveedor</th>
			<th>Vendedor</th>
			<!--<th>Articulo</th>-->
			<!--<th>Cantidad</th>-->
			<th>Monto Total</th>
			<th>Archivos</th>
			<th>Fecha de Registro</th>
			<th>status</th>			
			<!--<td></td>-->
			<th></th>
		</tr>
		</thead>
		<tbody>
	 @foreach($compras as $compra)
	 	@if($compra->status != 6)
	 	<tr>
	 		<td>{{$compra->id}}</td>
	 		<td><a class="btn btn-primary" href="{{URL::route('cotizacionMostrarForm')}}/{{$compra->cotizacion}}">{{$compra->cotizacion}}</a></td>
	 		<td>{{$compra->pn}}</td>
	 		<td>{{$compra->vn}}</td>
	 		<td>$ {{number_format($compra->totala*$compra->can,2,".",",")}}</td>
	 		<td>
	 			@if($compra->orden != null)
	 				<a target="_blank" href="{{URL::route('mostrarOrden')}}/{{$compra->id}}">Orden</a><br>
	 			@endif
	 			@if($compra->anticipo != null)
	 				<a target="_blank" href="{{URL::route('mostrarAnticipo')}}/{{$compra->id}}">Anticipo</a>
	 			@endif
	 		</td>
	 		<td>
	 			<?php $date = date_create($compra->created_at); ?>	
	 			{{date_format($date,"d-m-Y H:i:s")}}
	 		</td>
	 		<td>
	 			@if($compra->status == 1 || $compra->status == 2)
					Pendiente
	 			@endif
	 			@if($compra->status == 3)
					Comprado
	 			@endif
	 			@if($compra->status == 4)
					Recibido
	 			@endif
	 			@if($compra->status == 5)
					Maquila
	 			@endif
	 			@if($compra->status == 6)
					Entregado
	 			@endif
	 		</td>
	  		<td width="1%" align="center">
	  			@if($compra->maquila_status == 1)
	 			<a href="{{URL::route('comprasMaquilarForm')}}/{{$compra->id}}" class="btn btn-green btn-xs"> Maquilar</a>
				@endif
	  		</td>
	 	</tr>
	 	@endif
	 @endforeach
	  </tbody>		
	</table>
 
 <h3>Pedidos finalizados</h3>
	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Codigo</th>
			<th>Vendedor</th>
			<!--<th>Articulo</th>-->
			<!--<th>Cantidad</th>-->
			<th>Monto Total</th>
			<th>Archivos</th>
			<th>Fecha de Registro</th>
			<th>status</th>			
			<!--<td></td>-->
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
	 @foreach($compras as $compra)
	 	@if($compra->status == 6)
	 	<tr>
	 		<td>{{$compra->id}}</td>
	 		<td>{{$compra->vn}}</td>
	 		<td>$ {{number_format($compra->totala*$compra->can,2,".",",")}}</td>
	 		<td>
	 			@if($compra->orden != null)
	 				<a target="_blank" href="{{URL::route('mostrarOrden')}}/{{$compra->id}}">Orden</a><br>
	 			@endif
	 			@if($compra->anticipo != null)
	 				<a target="_blank" href="{{URL::route('mostrarAnticipo')}}/{{$compra->id}}">Anticipo</a>
	 			@endif
	 		</td>
	 		<td>
	 			<?php $date = date_create($compra->created_at); ?>	
	 			{{date_format($date,"d-m-Y H:i:s")}}
	 		</td>
	 		<td>
	 			@if($compra->status == 1 || $compra->status == 2)
					Pendiente
	 			@endif
	 			@if($compra->status == 3)
					Comprado
	 			@endif
	 			@if($compra->status == 4)
					Recibido
	 			@endif
	 			@if($compra->status == 5)
					Maquila
	 			@endif
	 			@if($compra->status == 6)
					Entregado
	 			@endif
	 		</td>
			<td>
				@if($compra->status == 1)
				<a href="" class="btn btn-danger btn-xs"> Comprar</a>
				@endif
				@if($compra->status == 3)
				<a href="" class="btn btn-warning btn-xs"> Recibir</a>
				@endif
				@if($compra->status == 4)
	 			<a href="" class="btn btn-green btn-xs"> Maquilar</a>
				@endif
				@if($compra->status == 5)
				<a href="" class="btn btn-primary btn-xs"> Entregado</a>
				@endif
			</td>
	  		<td width="1%" align="center">
	  			@if($compra->status >= 2)
	  			<a href="{{URL::route('comprasMostrarForm')}}/{{$compra->id}}" class="label label-primary">
	  			<i class="fa fa-search"></i> Ver</a>
	  			@endif
	  		</td>
	 	</tr>
	 	@endif
	 @endforeach
	  </tbody>		
	</table>

@endif

@stop
@section("js")
@stop