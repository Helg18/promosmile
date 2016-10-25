@extends("dashboard.layouts.default")

@section('title')
	clientes
@stop

@section("css")
@stop

@section("pagina")
	<h2>Clientes</h2>
@stop

@section("contenido")
<!---alert mensajes --->
            @if(Session::has('msg'))
            <div class="alert alert-{{ Session::get('class') }}">
              <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
              </button>
              {{ Session::get('msg')}}
              <br/>
            </div>
            @endif
            
            <div class="alert alert-error" id="alert" style="display:none">
              <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
              </button>
                Los cambios no fueron realizados, intente de nuevo
              <br/>
            </div>
            <!---/.alert mensajes -->
  <fieldset>
  	<a href="{{URL::route('clientesForm')}}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Cliente</a>
  </fieldset>

	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Cliente</th>
			<th>Persona de Contacto</th>
			<th>Fecha de Registro</th>			
			<th></th>
      <th></th>
      <th></th>
      <th></th>
		</tr>
		</thead>
		<tbody>
	 @foreach($clientes as $cliente)
	 	<tr>
	 		<td>{{$cliente->nombre}}</td>
	 		<td>{{$cliente->persona_contacto}}</td>
	 		<td>
        <?php $date = date_create($cliente->created_at); ?>
        {{date_format($date,"d-m-Y")}}
      </td>

	 		<td width="2%" align="center"><a href="{{URL::route('clientesHistorial')}}/{{$cliente->id}}" class="label label-primary"><i class="fa fa-search"></i>Cotizaciones</a></td>
	  	<td width="2%" align="center"><a href="{{URL::route('clientesMostrarForm')}}/{{$cliente->id}}" class="label label-primary"><i class="fa fa-search"></i> Ver</a></td>
	 		<td width="2%" align="center"><a href="{{URL::route('clientesEditarForm')}}/{{$cliente->id}}" class="label label-warning"><i class="fa fa-pencil"></i> Editar</a></td>
	 		<td width="2%" align="center"><a href="{{URL::route('clientesEliminar')}}/{{$cliente->id}}" onclick="return confirmar('accion.html')" class="label label-danger"><i class="fa fa-trash-o"></i> Eliminar</a></td>
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