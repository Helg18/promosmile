@extends("dashboard.layouts.default")

@section("title")
  Ver almacén
@stop

@section("css")
@stop

@section("pagina")
  <h2>Ver almacén</h2>
@stop

@section("contenido")
  <form action="{{URL::route('proveedoresMostrarForm')}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-6">
      <fieldset>
        <legend>
          Datos Personales
        </legend>     
          <p><span class="text-primary ">Persona de contacto: </span><u> {{$almacen->persona_contacto}}</u></p>
          <p><span class="text-primary ">E-mail: </span><u> {{$almacen->email}}</u></p>
          <p><span class="text-primary ">Teléfono: </span><u> {{$almacen->telefono}}</u></p>
      </fieldset>
    </div>

    <div class="col-md-6">
      <fieldset>
        <legend>
          Dirección
        </legend>
          <p><span class="text-primary ">Almacén:</span> <u >{{$almacen->nombre}}</u></p>
          <p><span class="text-primary ">RFC: </span> <u>{{$almacen->rfc}}</u></p>
          <p><span class="text-primary ">Calle: </span><u> {{$almacen->calle}}</u></p>
          <p><span class="text-primary ">Número exterior: </span><u> {{$almacen->numexterior}}</u></p>
          <p><span class="text-primary ">Número interior: </span><u> {{$almacen->numinterior}}</u></p>
          <p><span class="text-primary ">Colonia: </span><u> {{$almacen->colonia}}</u></p>
          <p><span class="text-primary ">CP: </span><u> {{$almacen->cp}}</u></p>
          <p><span class="text-primary ">Municipio: </span><u> {{$almacen->municipio}}</u></p>
          <p><span class="text-primary ">Pais: </span><u> {{$almacen->pais}}</u></p>
      </fieldset>
    </div>

    <div class="col-md-10" >
      <div class="form-group">  
        <a class="btn btn-warning" href="{{URL::route('almacenLista')}}" >Regresar</a>
      </div>
    </div>

  </form>
@stop

@section("js")
@stop