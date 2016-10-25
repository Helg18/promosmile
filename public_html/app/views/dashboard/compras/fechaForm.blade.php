@extends('dashboard.layouts.default')

@section('title')
	Fecha de entrega
@stop

@section('css')
@stop

@section('pagina')
	<h2>Fecha de entrega</h2>
@stop

@section('contenido')
	<form action="{{URL::route('entregasFecha')}}" method="post">
			<input type="hidden" name="id" value="{{$id}}">
			<fieldset>
			   <legend>Asignar fecha de entrega</legend>
			   <div class="col-sm-7">
                <small>{{$errors->first("fecha")}}</small>
                <p class="input-group input-append datepicker2 date col-md-8">
                     <input type="text" name="fecha" id="fecha" data-id="fecha" data-fecha="" placeholder=""  class="form-control"/>
                     <span class="input-group-btn">
                       <button type="button" class="btn btn-default">
                         <i class="glyphicon glyphicon-calendar"></i>
                       </button> </span>
                    </p>
              </div>
              <div class="col-sm-1">
              	<input type="submit"  value="Asignar" class="btn btn-success">
              </div>
			</fieldset>
	</form>
@stop

@section('js')
	
@stop