@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
  <h2>Ver Maquileros</h2>
@stop

@section("contenido")
  <form action="{{URL::route('proveedoresMostrarForm')}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-6">
      <fieldset>
        <legend>
          Datos 
        </legend>
          <p><span class="text-primary ">Nombre:</span> <u >{{$maquileros->nombre}}</u></p>
          <p><span class="text-primary ">Persona de contacto: </span><u> {{$maquileros->persona_contacto}}</u></p>
          <p><span class="text-primary ">E-mail: </span><u> {{$maquileros->email}}</u></p>
          <p><span class="text-primary ">Teléfono: </span><u> {{$maquileros->telefono}}</u></p>
          <p><span class="text-primary ">Especialidad: </span><u> {{$maquileros->especialidad}}</u></p>
          <p><span class="text-primary ">Información Adicional: </span><u> {{$maquileros->infoadicional}}</u></p>          
      </fieldset>
    </div>

    <div class="col-md-6">
      <fieldset>
        <legend>
          Dirección
        </legend>
          <p><span class="text-primary ">RFC: </span> <u>{{$maquileros->rfc}}</u></p>
          <p><span class="text-primary ">Calle: </span><u> {{$maquileros->calle}}</u></p>
          <p><span class="text-primary ">Número exterior: </span><u> {{$maquileros->numexterior}}</u></p>
          <p><span class="text-primary ">Número interior: </span><u> {{$maquileros->numinterior}}</u></p>
          <p><span class="text-primary ">Colonia: </span><u> {{$maquileros->colonia}}</u></p>
          <p><span class="text-primary ">CP: </span><u> {{$maquileros->cp}}</u></p>
          <p><span class="text-primary ">Municipio: </span><u> {{$maquileros->municipio}}</u></p>
          <p><span class="text-primary ">Pais: </span><u> {{$maquileros->pais}}</u></p>
      </fieldset>
    </div>

    <div class="col-md-10" >
      <div class="form-group">
        <a class="btn btn-warning" href="{{route('maquileros.index')}}" >Regresar</a>
      </div>
    </div>

  </form>
@stop

@section("js")
@stop
