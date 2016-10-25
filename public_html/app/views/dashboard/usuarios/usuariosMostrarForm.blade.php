@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
  <h2>Ver usuario</h2>
@stop

@section("contenido")
  <form action="{{URL::route('usuariosMostrarForm')}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-8">

      <fieldset>
        <legend>
          Datos del Usuario
        </legend>
          <p><span class="text-primary ">Nombres:</span> <u >{{$usuarios->first_name}}</u></p>
          <p><span class="text-primary ">Apellidos </span><u> {{$usuarios->last_name}}</u></p>
          <p><span class="text-primary ">Usuario </span><u> {{$usuarios->username}}</u></p>          
          <p><span class="text-primary ">E-mail: </span><u> {{$usuarios->email}}</u></p>
         
      </fieldset>
    </div>

    <div class="col-md-10" >
      <div class="form-group">  
        <a class="btn btn-warning" href="{{URL::route('usuarios')}}" >Regresar</a>
      </div>
    </div>

  </form>
@stop

@section("js")
@stop