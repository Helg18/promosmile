@extends("dashboard.layouts.default")

@section("title")
@stop

@section("css")
@stop

@section("pagina")
  <h2>Maquilero </h2>
@stop

@section("contenido")
  
  <div id="alerta" class="alert alert-danger" style="display:none;">
    No se a adjuntado la orden de producción...
  </div>

  <form action="{{URL::route('cmaquilarSave')}}" enctype="multipart/form-data" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" value="{{$datos}}">

     <div class="col-md-3" >
      <div class="form-group">
        <label for="">Maquilero
          {{($errors->first("maquilero")) ? $errors->first("maquilero")." <span class='symbol required'></span>": ''}}
        </label>
          <select name="maquilero" value="{{Input::old('maquillero')}}" class="form-control" placeholder="Ingresar maquillero" required>
            <option value="" hidden="0">Seleccione Maquilero</option>
              @foreach($maquileros as $m)
                <option value="{{$m->id}}"/>{{$m->nombre}}</option>
              @endforeach 
          </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-3" >
        <label for="">Costo de Maquila
                  {{($errors->first("costo")) ? $errors->first("costo")." <span class='symbol required'></span>": ''}}
              </label>
        <input type="text" name="costo" value="{{(Input::old('costo')) ? Input::old('costo') : $c}}" class="form-control"  class="form-control" placeholder="Ingresar Costo de Maquila">
      </div>
    </div>
    
    <div class="col-md-3" >
      <div class="form-group">
        <label for="">Fecha estimada de Entrega 
                  {{($errors->first("fechaentrega")) ? $errors->first("fechaentrega")." <span class='symbol required'></span>": ''}}
              </label>
        <input type="date" name="fechaentrega" value="{{Input::old('fechaentrega')}}" class="form-control" placeholder="Ingresar Fecha estimada de Entrega  ">
      </div>
    </div>

     <div class="col-md-3" >
      <div class="form-group">
        <label for="">Orden de producción</label>
        <input id="file" type="file" name="file" value="" class="form-control">
      </div>
    </div>

<div class="col-md-12">                       
            <div class="form-group">
              <button id="guardar" type="submit" id="guardar" class="btn btn-wide btn-primary pull-right">
                Guardar
              </button>
              <a class="btn btn-warning" href="{{URL::route('compras')}}" >Regresar</a>
            </div>
          </div>
</form>	
@stop

@section("js")
<script type="text/javascript">
    $(document).ready(function(){
        $("#guardar").click(function(){
             var val = $("#file").val();
             if(val == "") {
                $("#alerta").show();
                return false;
             } else {
                return true;
             }
        });
    });
</script>

@stop