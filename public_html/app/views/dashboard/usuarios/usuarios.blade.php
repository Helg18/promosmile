@extends("dashboard.layouts.default")

@section('title')
	Usuarios
@stop

@section("css")
@stop

@section("pagina")
	<h2>Usuarios</h2>
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
  	<a href="{{URL::route('usuariosForm')}}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Usuario</a>
  </fieldset>
	<table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Usuario</th>			
			<th>Email</th>
			<th></th>
			<th></th>
			<th></th>

		</tr>
	   </thead>
	 @foreach($usuarios as $usuario)
	 	<tbody>
	 	<tr>
	 		<td>{{$usuario->first_name}}</td>
		 	<td>{{$usuario->last_name}}</td>
	 		<td>{{$usuario->username}}</td>
	 		<td>{{$usuario->email}}</td>
	 		<td width="1%" align="center"><a href="{{URL::route('usuariosMostrarForm')}}/{{$usuario->id}}" class="label label-primary"><i class="fa fa-search"></i> Ver</a></td>
	 		<td width="1%" align="center"><a href="{{URL::route('usuariosEditarForm')}}/{{$usuario->id}}" class="label label-warning"><i class="fa fa-pencil"></i> Editar</a></td>
	 		<td width="1%" align="center"><a href="{{URL::route('usuariosEliminar')}}/{{$usuario->id}}" onclick="return confirmar('accion.html')" class="label label-danger"><i class="fa fa-trash-o"></i> Eliminar</a></td>
	 	</tr>
	 	</tbody>
	 @endforeach		
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