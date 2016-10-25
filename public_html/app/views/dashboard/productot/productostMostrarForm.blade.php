@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
  <h2>Ver Producto Terminado</h2>
@stop

@section("contenido")
  <form action="{{URL::route('productostMostrarForm')}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-6">
      <fieldset>
        <legend>
          Datos Personales
        </legend>     
          <p><span class="text-primary ">Nombre:</span> <u >{{$productost->nombre}}</u></p>
          <p><span class="text-primary ">Persona de contacto: </span><u> {{$productost->persona_contacto}}</u></p>
          <p><span class="text-primary ">E-mail: </span><u> {{$productost->email}}</u></p>
          <p><span class="text-primary ">Teléfono: </span><u> {{$productost->telefono}}</u></p>
      </fieldset>
    </div>

    <div class="col-md-6">
      <fieldset>
        <legend>
          Dirección
        </legend>
          <p><span class="text-primary ">RFC: </span> <u>{{$productost->rfc}}</u></p>
          <p><span class="text-primary ">Calle: </span><u> {{$productost->calle}}</u></p>
          <p><span class="text-primary ">Número exterior: </span><u> {{$productost->numexterior}}</u></p>
          <p><span class="text-primary ">Número interior: </span><u> {{$productost->numinterior}}</u></p>
          <p><span class="text-primary ">Colonia: </span><u> {{$productost->colonia}}</u></p>
          <p><span class="text-primary ">CP: </span><u> {{$productost->cp}}</u></p>
          <p><span class="text-primary ">Municipio: </span><u> {{$productost->municipio}}</u></p>
          <p><span class="text-primary ">Pais: </span><u> {{$productost->pais}}</u></p>
      </fieldset>
    </div>

    <div class="col-md-10" >
      <div class="form-group">  
        <a class="btn btn-warning" href="{{URL::route('productost')}}" >Regresar</a>
      </div>
    </div>

  </form>
@stop

@section("js")
@stop