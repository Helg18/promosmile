@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
  <h2>Ver vendedores</h2>
@stop

@section("contenido")
  <form action="{{URL::route('vendedoresMostrarForm')}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-13">

      <fieldset>
        <legend>
          Datos del Vendedor
        </legend>
          <p><span class="text-primary ">Nombres:</span> <u >{{$vendedor->nombre}}</u></p>
          <p><span class="text-primary ">Apellido Paterno:</span><u> {{$vendedor->apellidopaterno}}</u></p>
          <p><span class="text-primary ">Apellido Materno:</span><u> {{$vendedor->apellidomaterno}}</u></p>          
          <p><span class="text-primary ">E-mail: </span><u> {{$vendedor->email}}</u></p>
          <p><span class="text-primary ">Teléfono: </span><u> {{$vendedor->telefono}}</u></p>
         
      </fieldset>

      <fieldset>
    <legend>
      Cotizaciones
    </legend>
    <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_1">
      <thead>
      <tr>
        <th>Fecha de Registro</th>     
        <th>Articulos</th> 
        <th>Cantidad</th>
        <th>Total</th>
      </tr>
      </thead>
      <tbody>
      @foreach($cotizaciones as $co)
        <tr>
          <td>{{$co->fecha}}</td>
          <td>@foreach(Articulocotizaciones::where("cotizacion","=",$co->id)->get() as $artco)
          {{$artco->Articulos->nombre}}<br>
              @endforeach
          </td>
          <td>{{Articulocotizaciones::where("cotizacion","=",$co->id)->count()}}</td>
          <td>{{number_format(Articulocotizaciones::where("cotizacion","=",$co->id)->sum('total'), 2, ".",",") }}</td>
        </tr>
      @endforeach
      </tbody>    
    </table>
  </fieldset>

  <fieldset>
    <legend>
      Pedidos
    </legend>
    <table class="table-dark table table-striped table-bordered table-hover margin-0px" id="sample_2">
      <thead>
      <tr>
        <th>Fecha de Registro</th>      
        <th>Articulos</th>
        <th>Cantidad</th>
        <th>Total</th>
      </tr>
      </thead>
      <tbody>
      @foreach($compras as $com)
        <tr>
          <td>{{$com->fecha}}</td>
          <td>@foreach(ArticuloCompra::where("compra","=",$com->id)->get() as $artcom)
          {{$artcom->Articulos->nombre}}<br>
              @endforeach
          </td>
          <td>{{ArticuloCompra::where("compra","=",$com->id)->count()}}</td>
          <td>{{number_format(ArticuloCompra::where("compra","=",$com->id)->sum('total'), 2, ".",",") }}</td>
        </tr>
      @endforeach
      </tbody>    
    </table>
  </fieldset>

    <div class="col-md-10" >
      <div class="form-group">  
        <a class="btn btn-warning" href="{{URL::route('vendedores')}}" >Regresar</a>
      </div>
    </div>

  </form>
    </div>

@stop

@section("js")
@stop