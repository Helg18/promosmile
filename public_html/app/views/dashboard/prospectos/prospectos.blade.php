@extends("dashboard.layouts.default")

@section('title')
	prospectos
@stop

@section("css")
@stop

@section("pagina")
	<h2>Prospectos</h2>
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

	

 <div class="alert alert-warning">Prospectos enviados: {{$restric}} </div>

  <fieldset>
  	<a href="{{URL::route('prospectosForm')}}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Prospecto</a>
  </fieldset>

	<table  class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Compañia</th>
			<th>E-mail</th>
			<th>Vendedor</th>			
			<th></th>
		</tr>
		</thead>
		<tbody>
	 @foreach($prospectos as $prospecto)
	 	<tr>
	 		<td>{{$prospecto->nombre}}</td>
	 		<td>{{$prospecto->compania}}</td>
	 		<td>{{$prospecto->email}}</td>
            <td>@foreach(User::where('id','=',$prospecto->vendedor)->get() as $category)
             {{$category->first_name}}  {{$category->last_name}}
              @endforeach</td>

	 		<td width="1%" align="center"><a href="{{URL::route('prospectosMostrarForm')}}/{{$prospecto->id}}" class="label label-primary"><i class="fa fa-search"></i> Ver</a></td>
	 		<td width="1%" align="center"><a href="{{URL::route('prospectosEditarForm')}}/{{$prospecto->id}}" class="label label-warning"><i class="fa fa-pencil"></i> Editar</a></td>
	 		<td width="1%" align="center"><a href="{{URL::route('prospectosEliminar')}}/{{$prospecto->id}}" onclick="return confirmar('accion.html')" class="label label-danger"><i class="fa fa-trash-o"></i> Eliminar</a></td>
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