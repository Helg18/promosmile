@extends("dashboard.layouts.default")

@section("title")
	Cargar Imágenes
@stop

@section("css")
@stop

@section("pagina")
	<h2>Cargar Imágenes</h2>
@stop

@section("contenido")
	<h2 id="data" data-url="{{URL::route('saveImage')}}" data-token="{{csrf_token()}}">Arrastre Las imágenes hasta la caja</h2>
	<fieldset id="soltar" style="min-height:250px;"></fieldset>
	<div id="mensaje"></div>
@stop

@section("js")
<script src="{{asset('assets/js/files_up.js')}}"></script>
@stop