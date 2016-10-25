@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
  <h2>Ver prospecto</h2>
@stop

@section("contenido")
      <fieldset>
        <legend>
          Datos Personales
        </legend>     
          <p><span class="text-primary ">Nombre:</span> <u >{{$prospectos->nombre}}</u></p>
          <p><span class="text-primary ">Compañia: </span><u> {{$prospectos->compania}}</u></p>
          <p><span class="text-primary ">E-mail: </span><u> {{$prospectos->email}}</u></p>
          <p><span class="text-primary ">Teléfono: </span><u> {{$prospectos->telefono}}</u></p>
           <p><span class="text-primary ">Puesto: </span><u> {{$prospectos->puesto}}</u></p>
      </fieldset>
 

      <div class="form-group">  
        <a class="btn  btn-wide btn-warning pull-left" href="{{URL::route('prospectos')}}" >Regresar</a>
      </div>
 

@stop

@section("js")
@stop