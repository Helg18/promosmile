@extends("dashboard.layouts.default")

@section('title')
	Maquileros
@stop

@section("css")
@stop

@section("pagina")
	<h2>Maquileros</h2>
@stop

@section("contenido")

 <!---alert mensajes --->
@include('dashboard.maquileros.shared.msg')

            <div class="alert alert-error" id="alert" style="display:none">
              <button type="button" class="close" data-dismiss="alert">
                <i class="icon-remove"></i>
              </button>
                Los cambios no fueron realizados, intente de nuevo
              <br/>
            </div>
            <!---/.alert mensajes -->

  <fieldset>
  	<a href="{{URL::route('maquileros.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Maquilero</a>
  </fieldset>

  @include('dashboard.maquileros.shared.table')

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
