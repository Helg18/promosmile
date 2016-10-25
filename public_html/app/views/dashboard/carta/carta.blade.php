@extends("dashboard.layouts.default")

@section('title')
	Carta de presentación
@stop

@section("css")
@stop

@section("pagina")
	<h2>Carta de presentación</h2>
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
            
  <fieldset>
  	@foreach($carta as $cartas)
  	<p>Hola estimado/a____________: </p>
     {{$cartas->mensaje}}
  		
  </fieldset>

  <div class="col-md-10" >
			<div class="form-group">	
				<a href="{{URL::route('cartaEditarForm')}}/{{$cartas->id}}" class="btn btn-warning" >Editar Mensaje</a>
				<a class="btn btn-success"  target="_blank" href="{{asset('uploads/'.$cartas->filename)}}" >Ver Archivo Adjunto</a><br><br>

	<form id="form"  enctype="multipart/form-data"  method="post"  action="{{URL::route('archivoSave')}}" class="form-horizontal">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="id" value="{{$cartas->id}}">
				<span class="btn btn-wide btn-default btn-squared fileinput-button"> <i class="glyphicon glyphicon-plus"> </i> 
				<span> Presionar aquí para cargar un nuevo archivo adjunto... </span>
                  <input id="imgs" required type="file" name="images[]"  id="file2" />                
                </span>

               <button class="btn btn-success" type="file" name="carta">Adjuntar</button>
			</div>
		</div>
	</form>

 @endforeach
@stop
@section("js")
@stop


