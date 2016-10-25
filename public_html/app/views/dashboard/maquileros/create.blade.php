@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
	<h2>Registro de Maquileros</h2>
@stop

@section("contenido")
    {{ Form::open(['route' => 'maquileros.store', 'method' => 'POST']) }}
        @include('dashboard.maquileros.includes.form-fields')
        <div class="col-md-10" >
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Guardar">
                <a class="btn btn-warning" href="{{route('maquileros.index')}}" >Regresar</a>
            </div>
        </div>
    {{ Form::close() }}
@stop

@section("js")
@stop
