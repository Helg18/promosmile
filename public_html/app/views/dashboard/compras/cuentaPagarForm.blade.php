@extends("dashboard.layouts.default")

@section("title")
	Pagar cuenta
@stop

@section("css")
@stop

@section("pagina")
	<h2>Pagar cuenta</h2>
@stop

@section("contenido")
	<form action="{{URL::route('cuentaPagar')}}" method="post" class="form-group">
		<ul class="list-group">
			<li class="list-group-item">Total: $ {{number_format($c->total*$c->cantidad,2,".",",")}}</li>
			<li class="list-group-item">Pagado: $ {{number_format($c->pagado,2,".",",")}}</li>
			<li class="list-group-item">Deuda: $ {{number_format(($c->total*$c->cantidad)-$c->pagado,2,".",",")}}</li>
			
		</ul>

		<div class="col-md-8">
		<input type="hidden" value="{{$id}}" name="id">
		<small>{{$errors->first("monto")}}</small>
		<input class="form-control " name="monto" type="text" placeholder="Moto a cobrar">
		</div>	
			<input class="btn btn-success" type="submit" value="Cobrar">
	</form>
@stop

@section("js")
@stop