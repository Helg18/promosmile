@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
  <h2>Ver clientes</h2>
@stop

@section("contenido")
  <form action="{{URL::route('clientesMostrarForm')}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-6">

      <fieldset>
        <legend>
          Datos Personales
        </legend>
          <p><span class="text-primary ">Nombre:</span> <u >{{$cliente->nombre}}</u></p>
          <p><span class="text-primary ">Persona de contacto: </span><u> {{$cliente->persona_contacto}}</u></p>
          <p><span class="text-primary ">E-mail: </span><u> {{$cliente->email}}</u></p>
          <p><span class="text-primary ">Teléfono: </span><u> {{$cliente->telefono}}</u></p>
      </fieldset>
    </div>

    <div class="col-md-6">
      <fieldset>
        <legend>
          Dirección
        </legend>
          <p><span class="text-primary ">RFC: </span> <u>{{$cliente->rfc}}</u></p>
          <p><span class="text-primary ">Calle: </span><u> {{$cliente->calle}}</u></p>
          <p><span class="text-primary ">Número exterior: </span><u> {{$cliente->numexterior}}</u></p>
          <p><span class="text-primary ">Número interior: </span><u> {{$cliente->numinterior}}</u></p>
          <p><span class="text-primary ">Colonia: </span><u> {{$cliente->colonia}}</u></p>
          <p><span class="text-primary ">CP: </span><u> {{$cliente->cp}}</u></p>
          <p><span class="text-primary ">Municipio: </span><u> {{$cliente->municipio}}</u></p>
          <p><span class="text-primary ">Pais: </span><u> {{$cliente->pais}}</u></p>
      </fieldset>
    </div>
    <div class="col-md-10" >
      <div class="form-group">  
        <a class="btn  btn-wide btn-warning pull-left" href="{{URL::route('clientes')}}" >Regresar</a>
      </div>
    </div>

  </form>
@stop

@section("js")
@stop