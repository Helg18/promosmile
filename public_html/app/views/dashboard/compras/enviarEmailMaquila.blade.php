@extends("dashboard.layouts.default")

@section("title")
	Enviar E-mail
@stop

@section("css")
@stop

@section("pagina")
	Enviar E-mail
@stop

@section("contenido")
	<form class="form-group" action="{{URL::route('emailMaquilero')}}" method="post">
		<input type="hidden" name="id" value="{{$id}}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="file"   value="{{$file}}">
		<input type="hidden" name="nombre" value="{{$mq->nombre}}">
		<div class="col-md-8">
			<small>Para</small>	
			<input type="text" class="form-control" value="{{$mq->email}}" name="email" readonly>
		</div>
		<div class="col-md-8">
			<small>CC</small>	
			<input type="text" name="cc" class="form-control">
		</div>
		<div class="col-md-8">
			<small>Asunto</small>	
			<input type="text" name="asunto" class="form-control">
		</div>
		<div class="col-md-8">
			<small>Mensaje</small>	
			<textarea class="form-control" name="mensaje"></textarea>
		</div>
		<div class="col-md-8">
			<p></p>
			<button class="btn btn-primary pull-left">Enviar</button>
			<a class="btn btn-warning" href="{{ URL::previous() }}" >Regresar</a>
			<a href="{{URL::route('vistaPrevia')}}/{{$cm}}" target="_blank" class="btn btn-primary pull-right">Vista previa</a>
		</div>
	</form> 
@stop

@section("js")
@stop
