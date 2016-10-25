@extends("dashboard.layouts.default")

@section("title")
Ver Historial de Cotizaviones
@stop

@section("css")
@stop

@section("pagina")
  <h2>Ver Historial de Cotizaciones</h2>
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
  <input name="_token" type="hidden" value="{{csrf_token()}}">
  <fieldset>
    <legend>
      Cliente
    </legend>   
      {{$cliente->nombre}}                
  </fieldset>


  <fieldset>
    <legend>
      Cotizaciones
    </legend>
   <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
    <thead>
    <tr>
      <th>Código</th>
      <th>Fecha</th>
      <!--<th>Articulo</th>     
      <th>Cantidad</th>-->
      <th>Monto Total</th>
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
      <td>$ {{number_format($cotiza->total,2,".",",")}}</td>
    </tr>
    @endforeach
      </tbody>    
    </table>
  </fieldset>

  


@stop

@section("js")
@stop