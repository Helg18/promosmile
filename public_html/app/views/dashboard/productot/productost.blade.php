@extends("dashboard.layouts.default")

@section('title')
	Producto Terminado
@stop

@section("css")
@stop

@section("pagina")
	<h2>Producto Terminado</h2>
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
  	<a href="{{URL::route('productostForm')}}" class="btn btn-success"><i class="fa fa-plus"></i>Producto Terminado</a>
  </fieldset>

	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Persona Contacto</th>
			<th>Fecha de Registro</th>			
			<th>Opciones</th>
		</tr>
		</thead>
		<tbody>
	 @foreach($productost as $p)
	 	<tr>
	 		<td>{{$p->nombre}}</td>
	 		<td>{{$p->persona_contacto}}</td>
	 		 <td>{{$p->created_at}}</td>
	 		

	 		<td width="21%" align="center">
	 			<a href="{{URL::route('productostMostrarForm')}}/{{$p->id}}" class="label label-primary"><i class="fa fa-search"></i> Ver</a>
	 			<a href="{{URL::route('productostEditarForm')}}/{{$p->id}}" class="label label-warning"><i class="fa fa-pencil"></i> Editar</a>
	 			<a href="{{URL::route('productostEliminar')}}/{{$p->id}}" onclick="return confirmar('accion.html')" class="label label-danger"><i class="fa fa-trash-o"></i> Eliminar</a>
	 		</td>
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