@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
  <h2>Ver proveedores</h2>
@stop

@section("contenido")
  <form action="{{URL::route('proveedoresMostrarForm')}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-6">
      <fieldset>
        <legend>
          Datos Personales
        </legend>     
          <p><span class="text-primary ">Nombre:</span> <u >{{$proveedor->nombre}}</u></p>
          <p><span class="text-primary ">Persona de contacto: </span><u> {{$proveedor->persona_contacto}}</u></p>
          <p><span class="text-primary ">E-mail: </span><u> {{$proveedor->email}}</u></p>
          <p><span class="text-primary ">Teléfono: </span><u> {{$proveedor->telefono}}</u></p>
          <p><span class="text-primary ">Descuento que aplica: </span> <u>{{$proveedor->descuento}}%</u></p>

      </fieldset>
    </div>

    <div class="col-md-6">
      <fieldset>
        <legend>
          Dirección
        </legend>
          <p><span class="text-primary ">RFC: </span> <u>{{$proveedor->rfc}}</u></p>
          <p><span class="text-primary ">Calle: </span><u> {{$proveedor->calle}}</u></p>
          <p><span class="text-primary ">Número exterior: </span><u> {{$proveedor->numexterior}}</u></p>
          <p><span class="text-primary ">Número interior: </span><u> {{$proveedor->numinterior}}</u></p>
          <p><span class="text-primary ">Colonia: </span><u> {{$proveedor->colonia}}</u></p>
          <p><span class="text-primary ">CP: </span><u> {{$proveedor->cp}}</u></p>
          <p><span class="text-primary ">Municipio: </span><u> {{$proveedor->municipio}}</u></p>
          <p><span class="text-primary ">Pais: </span><u> {{$proveedor->pais}}</u></p>
      </fieldset>
    </div>


    <div class="col-md-10" >
      <div class="form-group">  
        <a class="btn btn-wide btn-warning" href="{{URL::route('proveedores')}}" >Regresar</a>
      </div>
    </div>

  </form>
@stop

@section("js")
@stop