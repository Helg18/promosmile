@extends("dashboard.layouts.default")

@section('title')
	Almacenes
@stop

@section("css")
@stop

@section("pagina")
	<h2>Almacenes</h2>
@stop

@section("contenido")
            
  <fieldset>
  	<a href="{{URL::route('almacenCrearForm')}}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Almacén</a>
  </fieldset>

	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Persona Contacto</th>
			<th>Fecha de Registro</th>			
			<th></th>
			<th></th>
			<th></th>

		</tr>
		</thead>
		<tbody>
	 @foreach($almacenes as $almacen)
	 	<tr>
	 		<td>{{$almacen->nombre}}</td>
	 		<td>{{$almacen->persona_contacto}}</td>
	 		 <td>
	 		 	<?php $date = date_create($almacen->created_at); ?>
	 		 	{{date_format($date,"d-m-Y")}}
	 		 </td>
	 		

	 		<td width="1%" align="center"><a href="{{URL::route('almacenVer')}}/{{$almacen->id}}" class="label label-primary"><i class="fa fa-search"></i> Ver</a></td>
	 		<td width="1%" align="center"><a href="{{URL::route('almacenEditarForm')}}/{{$almacen->id}}" class="label label-warning"><i class="fa fa-pencil"></i> Editar</a></td>
	 		<td width="1%" align="center"><a href="{{URL::route('almacenEliminar')}}/{{$almacen->id}}" onclick="return confirmar('accion.html')" class="label label-danger"><i class="fa fa-trash-o"></i> Eliminar</a></td>
	 	</tr>
	 @endforeach
	 </tbody>		
	</table>
@stop
@section("js")
<script>
function confirmar(url)
{
  if(confirm('¿Esta seguro de eliminar este registro?'))
  {
    window.location=url;
  }
  else
  {
    return false;
  } 
}
</script>
@stop