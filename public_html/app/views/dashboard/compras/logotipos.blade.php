@extends("dashboard.layouts.default")

@section("title")
	Logotipos
@stop

@section("css")
@stop

@section("pagina")
	Logotipos
@stop

@section("contenido")
		<a id="addLogo" class="btn btn-success pull-right">Agregar Logotipo</a>
		<a href="{{URL::route('compras')}}" class="btn btn-warning pull-left">Regresar</a>
		<p style="clear:both;"></p>
		<form action="{{URL::route('addLogo')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
			<input type="hidden" name="id" value="{{$id}}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div id="logotipos"></div>
			<input type="submit" style="display:none;" id="sub" class="btn btn-success" value="Guardar">
		</form>
	@if(count($l) > 0)
		<table class="table">
			<tr>
				<th>Logotipo</th>
				<th>Observaciones</th>
				<th style="text-align:center;" colspan="2">Opciones</th>
			</tr>
			@foreach($l as $ll)
				<tr>
					<td><img width="60" height="60" src="{{url()}}/logotipos/{{$ll->pedido_id}}/{{$ll->imagen}}" alt=""></td>
					<td>{{$ll->observacion}}</td>
					<td>
						<a target="_blank" href="{{URL::route('descargarLogo')}}/{{$id}}/{{$ll->id}}">Descargar Logotipo</a>
					</td>
					<td>
						<a class="label label-danger" href="{{URL::route('eliminarLogtipo')}}/{{$ll->id}}">Eliminar
						</a>
					</td>
				</tr>
			@endforeach
		</table>
	@else
		<div class="alert alert-warning">
			No se adjuntaron logotipos
		</div>
	@endif
@stop

@section("js")
	<script type="text/javascript">
		$(document).ready(function(){
			$("#addLogo").click(function(){
              $("#logotipos").append("<div class='form-group'><label class='col-sm-2 control-label' for=''>Logotipo </label><div class='col-sm-7'><div class='input-group'><input type='file' class='form-ntrol' name='logotipo[]'></div></div></div><div class='form-group'><label class='col-sm-2 control-label' for=''> Observaciones</label><div class='col-sm-7'><div class='input-group col-sm-12'><input type='text' class='form-control' name='observaciones[]'></div></div></div>");
          	 $("#sub").show();
          });
		});
	</script>
@stop

