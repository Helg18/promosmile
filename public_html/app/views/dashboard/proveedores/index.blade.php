@extends ('dashboard.layouts.default')

@section ('title')
  Proveedores
@stop
@section ('cssPage')
  {{HTML::style('assetss/css/vendors/x-editable/address.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/select2.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/typeahead.js-bootstrap.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/demo-bs3.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/select2-bootstrap.css')}}
  {{HTML::style('assetss/css/vendors/x-editable/bootstrap-editable.css')}}
  
@stop
@section('pagina')
  <h2>Proveedores</h2>
@stop
@section ('contenido')
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
      <a href="{{URL::route('create.proveedores')}}" class="btn btn-wide btn-primary pull-left"><i class="fa fa-plus"></i> Agregar</a>
    </fieldset>
	  <div class="row">

	    <div class="col-md-12">
        <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Contacto</th>             
              <th>Telefono</th>
              <th>Correo</th>
              <th>Ver</th>  
              <th>Editar</th>       
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
             @foreach($proveedores as $p)
            <tr>
              <td>{{$p->nombre}}</td>
              <td>{{$p->contacto}} </td>
              <td>{{$p->telefono }}</td>
              <td>{{$p->correo }}</td>
              
              <td width="2%" align="center">
                <a href="{{ URL::to('dashboard/proveedores/show/'.$p->id) }}" class="btn bnt-wide btn-blue"><i class="fa fa-search"></i></a>
              </td>
              <td width="2%" align="center">
                <a  href="{{ URL::to('dashboard/proveedores/edit/'.$p->id) }}"   class="btn bnt-wide btn-yellow"><i class="fa fa-pencil"></i></a>
              </td>
              <td width="2%" align="center"> 
                <a  href="{{ URL::to('dashboard/proveedores/delete/'.$p->id) }}" onclick="return confirmar('accion.html')" class="btn bnt-wide btn-red"><i class="fa fa-trash-o"></i></a>
              </td>
             
            </tr> 
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@stop


@section('js')
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