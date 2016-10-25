@extends("dashboard.layouts.default")

@section("title")
Carta de presentación
@stop

@section("css")
@stop

@section("pagina")
	<h2>Editar carta de presentación</h2>
@stop

@section("contenido")

<form action="{{URL::route('cartaSave')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$carta->id}}">
	<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title">Mensaje - <span class="text-bold">Carta de Presentación</span></h5>
									<p class="margin-bottom-30">
										
									</p>
									<textarea name="mensaje" class="ckeditor form-control" cols="10" rows="10">{{$carta->mensaje}}</textarea>
									
								</div>
							</div>
						</div>
						<!-- end: TEXT EDITOR -->
					</div>
				</div>
			</div>

<div class="col-md-11" >
			<div class="form-group">	
				<input type="submit" class="btn btn-success btn-wide pull-right" value="Actualizar">
				<a class="btn btn-wide btn-warning pull-left" href="{{URL::route('carta')}}" >Regresar</a>
			</div>
		</div>
 </form>
@stop

@section("js")
@stop